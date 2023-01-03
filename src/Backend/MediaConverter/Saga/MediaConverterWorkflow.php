<?php

namespace App\Backend\MediaConverter\Saga;

use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\MediaConverter\Saga\MediaConvertActivityInterface;
use App\Shared\MediaConverter\Saga\MediaConvertWorkflowInterface;
use App\Shared\Video\VideoUpdateSrcWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Internal\Workflow\ChildWorkflowProxy;
use Temporal\Workflow;

class MediaConverterWorkflow implements MediaConvertWorkflowInterface
{
    private readonly ActivityProxy $mediaConvertActivity;

    public function __construct()
    {
        $this->mediaConvertActivity =  Workflow::newActivityStub(
            MediaConvertActivityInterface::class,
            ActivityOptions::new()
                ->withHeartbeatTimeout(CarbonInterval::minute(10))
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)
                )
                ->withStartToCloseTimeout(CarbonInterval::hour(24))
        );
    }

    protected function createUpdateSrcWorkflow(): ChildWorkflowProxy
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            VideoUpdateSrcWorkflowInterface::class,
            Workflow\ChildWorkflowOptions::new()
                ->withRetryOptions(
                    RetryOptions::new()->withMaximumAttempts(10)
                )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer)
    {
        $convertedCollection    = new MediaConvertedResultCollectionTransfer();
        $fileTransfer           = $mediaConfigurationTransfer->getFile();
        $mediaMetadataTransfer  = yield $this->mediaConvertActivity->extractMediaMetadata($fileTransfer);
        /** @var MediaResolutionCollectionTransfer $resolutionsCollection */
        $resolutionsCollection  = yield $this->mediaConvertActivity->calculateMediaResolutions($mediaMetadataTransfer);

        $convertedCollection->setVideoId($fileTransfer->getId());
        /** @var MediaResolutionTransfer[] $resolutionsArray */
        $resolutionsArray = $resolutionsCollection->getResolutions();
        $updateSource = count($resolutionsArray) === 1;
        foreach ($resolutionsArray as $resolutionTransfer) {
            $mediaConfigurationTransfer->setResolutionConfiguration($resolutionTransfer);

            /** @var MediaConvertedResultTransfer $videoConvertedTransfer */
            $videoConvertedTransfer = yield $this->mediaConvertActivity->convert($mediaConfigurationTransfer);
            $convertedCollection->setResults([$videoConvertedTransfer]);

            if (!$updateSource) {
                $updateSource = true;

                continue;
            }

            /** @var DashManifestTransfer $dashManifest */
            $dashManifest = yield $this->mediaConvertActivity->generateDashManifest($convertedCollection);

            yield $this
                ->createUpdateSrcWorkflow()
                ->updateVideoSrc(
                    (new VideoSrcSetTransfer())
                        ->setVideoId($mediaConfigurationTransfer->getVideo()->getId())
                        ->setSrc($dashManifest->getSrc())
                );
        }

        return $convertedCollection;
    }
}
