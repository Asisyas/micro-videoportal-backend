<?php

namespace App\Saga\VideoPublish\Workflow;

use App\Saga\VideoPublish\Activity\VideoPublishActivityInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;
use Carbon\CarbonInterval;
use Micro\Library\DTO\Object\Collection;
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

            $saga
                ->addCompensation(
                    fn() => yield $this->activity->removeSourceFile((new FileRemoveTransfer())->setId($fileTransfer->getId()))
                );

            $this->convertedResultCollection->setVideoId($fileTransfer->getId());

            /** @var MediaMetadataTransfer $mediaMetadataTransfer */
            $mediaMetadataTransfer                  = yield $this->activity->extractMediaMetadata($fileTransfer);
            $mediaResolutionsCollectionTransfer     = yield $this->activity->calculateMediaResolutions($mediaMetadataTransfer);
            $mediaConfigurationTransfer             = (new MediaConfigurationTransfer())->setFile($fileTransfer);

            /** @var MediaResolutionTransfer $resolutionTransfer */
            $i = 0;
            $dashManifest = null;
            foreach ($mediaResolutionsCollectionTransfer->getResolutions() as $resolutionTransfer) {
                $mediaConfigurationTransfer->setResolutionConfiguration($resolutionTransfer);

                /** @var MediaConvertedResultTransfer $videoConvertedTransfer */
                $videoConvertedTransfer = yield $this->activity->convert($mediaConfigurationTransfer);

                $this->convertedResultCollection->setResults([$videoConvertedTransfer]);

                if(1 > $i++) {
                    continue;
                }

                $dashManifest = yield $this->activity->generateDashManifest($this->convertedResultCollection);
            }

            return 'CONVERTED!';

        } catch (\Throwable $exception) {
            $saga->compensate();

            throw $exception;
        }
    }
}