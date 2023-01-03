<?php

namespace App\Backend\Video\VideoPublish\Saga;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\File\Saga\FileDeleteWorkflowInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\MediaConverter\Saga\MediaConvertWorkflowInterface;
use App\Shared\Video\VideoCreateWorkflowInterface;
use App\Shared\Video\VideoPublishActivityInterface;
use App\Shared\Video\VideoPublishWorkflowInterface;
use App\Shared\VideoDescription\Saga\VideoDescriptionCreateWorkflowInterface;
use App\Shared\VideoThumbnail\Saga\VideoThumbnailGenerateWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;
use Temporal\Workflow\Saga;

class VideoPublishWorkflow implements VideoPublishWorkflowInterface
{
    private ActivityProxy $activity;

    public function __construct()
    {
        // @phpstan-ignore-next-line
        $this->activity = Workflow::newActivityStub(
            VideoPublishActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::hour(24))
                ->withHeartbeatTimeout(CarbonInterval::minute(10))
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)
                        ->withNonRetryableExceptions([
                            NotFoundException::class
                        ])
                )
        );
    }

    /**
     * @return VideoThumbnailGenerateWorkflowInterface
     */
    protected function createVideoThumbnailGeneratorWorkflow()
    {
        return Workflow::newChildWorkflowStub(
            VideoThumbnailGenerateWorkflowInterface::class
        );
    }

    /**
     * @return VideoDescriptionCreateWorkflowInterface
     */
    protected function createVideoDescriptionWorkflow()
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            VideoDescriptionCreateWorkflowInterface::class
        );
    }

    /**
     * @return VideoCreateWorkflowInterface
     */
    protected function createVideoCreateWorkflow()
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            VideoCreateWorkflowInterface::class
        );
    }

    /**
     * @return MediaConvertWorkflowInterface
     */
    protected function createMediaConverterWorkflow()
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            MediaConvertWorkflowInterface::class
        );
    }

    /**
     * @return FileDeleteWorkflowInterface
     */
    protected function createFileDeleteWorkflow()
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            FileDeleteWorkflowInterface::class,
        );
    }

    /**
     * {@inheritDoc}
     */
    #[Workflow\WorkflowMethod("VideoPublish")]
    public function publish(VideoPublishTransfer $videoPublishTransfer)
    {
        $saga = new Saga();
        $saga->setParallelCompensation(true);
        $videoId            = $videoPublishTransfer->getFileId();
        $fileGetTransfer    = new FileGetTransfer();
        $fileRemoveTransfer = (new FileRemoveTransfer())
            ->setId($videoId);
        $videoGetTransfer   = (new VideoGetTransfer())
            ->setVideoId($videoId);

        $fileGetTransfer->setId($videoId);

        try {
            /** @var FileTransfer $fileTransfer */
            $fileTransfer = yield $this->activity->lookupSourceFile($fileGetTransfer);

            $saga->addCompensation(
                fn () => yield $this->createFileDeleteWorkflow()
                ->deleteFile($fileRemoveTransfer)
            );

            /** @var VideoTransfer $videoTransfer */
            $videoTransfer = yield $this
                ->createVideoCreateWorkflow()
                ->publishVideo($videoPublishTransfer);

            yield $this
                ->createVideoDescriptionWorkflow()
                ->create(
                    (new VideoDescriptionPutTransfer())
                    ->setVideoId($videoId)
                    ->setSource(
                        (new VideoDescriptionTransfer())
                            ->setTitle($fileTransfer->getName())
                    )
                );

            yield $this->activity->propagateVideo($videoGetTransfer);
            /** @var MediaConvertedResultCollectionTransfer $videoConverted */
            $videoConverted = yield $this->createMediaConverterWorkflow()->convert(
                (new MediaConfigurationTransfer())
                    ->setFile($fileTransfer)
                    ->setVideo($videoTransfer)
            );

            //$videoConverted->setResults();

            yield $this->createVideoThumbnailGeneratorWorkflow()->generateThumbnail($videoGetTransfer);

            yield $this->createFileDeleteWorkflow()
                ->deleteFile($fileRemoveTransfer);

            return $videoConverted;
        } catch (\Throwable $exception) {
            yield $saga->compensate();

            throw $exception;
        }
    }
}
