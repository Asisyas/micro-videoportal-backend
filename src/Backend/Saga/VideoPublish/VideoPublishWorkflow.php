<?php

namespace App\Backend\Saga\VideoPublish;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;
use App\Shared\Generated\DTO\Video\SourceTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;
use App\Shared\Saga\VideoPublish\VideoPublishWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;
use Temporal\Workflow\Saga;

class VideoPublishWorkflow implements VideoPublishWorkflowInterface
{
    /** @var VideoPublishActivityInterface */
    private ActivityProxy $activity;

    /** @var MediaConvertedResultCollectionTransfer  */
    private MediaConvertedResultCollectionTransfer $convertedResultCollection;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(
            VideoPublishActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::hour(24))
            //    ->withTaskQueue('VideoPublish')
                ->withRetryOptions(RetryOptions::new()->withMaximumAttempts(1))
        );

        $this->convertedResultCollection = new MediaConvertedResultCollectionTransfer();
        $this->convertedResultCollection->setResults([]);
    }

    /**
     * {@inheritDoc}
     */
    public function lookupStatus(): MediaConvertedResultCollectionTransfer
    {
        return $this->convertedResultCollection;
    }

    /**
     * {@inheritDoc}
     */
    #[Workflow\WorkflowMethod("VideoPublish")]
    public function publish(FileGetTransfer $fileGetTransfer)
    {
        $saga = new Saga();
        $saga->setParallelCompensation(true);

        try {
            /** @var FileTransfer $fileTransfer */
            $fileTransfer = yield $this->activity->lookupSourceFile($fileGetTransfer);

            /*
            $saga
                ->addCompensation(
                    fn() => yield $this->activity->removeSourceFile((new FileRemoveTransfer())->setId($fileTransfer->getId()))
                );
            */

            $videoTransfer = yield $this->activity->createVideo(
                (new VideoCreateTransfer())
                ->setFileId($fileTransfer->getId())
            );

            $this->convertedResultCollection->setVideoId($fileTransfer->getId());

            /** @var MediaMetadataTransfer $mediaMetadataTransfer */
            $mediaMetadataTransfer                  = yield $this->activity->extractMediaMetadata($fileTransfer);
            $mediaResolutionsCollectionTransfer     = yield $this->activity->calculateMediaResolutions($mediaMetadataTransfer);
            $mediaConfigurationTransfer             = (new MediaConfigurationTransfer())->setFile($fileTransfer);

            /** @var MediaResolutionTransfer $resolutionTransfer */
            $i = 0;
            foreach ($mediaResolutionsCollectionTransfer->getResolutions() as $resolutionTransfer) {
                $mediaConfigurationTransfer->setResolutionConfiguration($resolutionTransfer);

                /** @var MediaConvertedResultTransfer $videoConvertedTransfer */
                $videoConvertedTransfer = yield $this->activity->convert($mediaConfigurationTransfer);

                $this->convertedResultCollection->setResults([$videoConvertedTransfer]);

                if(1 > $i++) {
                    continue;
                }
                /** @var DashManifestTransfer $dashManifest */
                $dashManifest = yield $this->activity->generateDashManifest($this->convertedResultCollection);

                if($i === 2) {
                    $videoTransfer->setMedia((new SourceTransfer())->setSrc($dashManifest->getSrc()));
                    $videoTransfer = yield $this->activity->updateVideo($videoTransfer);
                }
            }

            return 'CONVERTED!';

        } catch (\Throwable $exception) {
            $saga->compensate();

            throw $exception;
        }
    }
}