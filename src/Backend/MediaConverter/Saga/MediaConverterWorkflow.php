<?php

namespace App\Backend\MediaConverter\Saga;

use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\MediaConverter\Saga\MediaConvertActivityInterface;
use App\Shared\MediaConverter\Saga\MediaConvertWorkflowInterface;
use App\Shared\Video\Saga\VideoUpdateSrcWorkflowInterface;
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
        $resolutionsCollection  = yield $this->mediaConvertActivity->calculateMediaResolutions($mediaMetadataTransfer);

        $convertedCollection->setVideoId($fileTransfer->getId());
        $i = 0;
        foreach ($resolutionsCollection->getResolutions() as $resolutionTransfer) {
            $mediaConfigurationTransfer->setResolutionConfiguration($resolutionTransfer);

            /** @var MediaConvertedResultTransfer $videoConvertedTransfer */
            $videoConvertedTransfer = yield $this->mediaConvertActivity->convert($mediaConfigurationTransfer);
            $convertedCollection->setResults([$videoConvertedTransfer]);

            if (1 > $i++) {
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

        return $mediaConfigurationTransfer;
    }
}
