<?php

namespace App\Backend\VideoPublish\Saga;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\File\Saga\FileDeleteWorkflowInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\MediaConverter\Saga\MediaConvertWorkflowInterface;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;
use App\Shared\Saga\VideoPublish\VideoPublishWorkflowInterface;
use App\Shared\Video\Saga\VideoCreateWorkflowInterface;
use App\Shared\VideoDescription\Saga\VideoDescriptionCreateWorkflowInterface;
use Carbon\CarbonInterval;
use Generator;
use React\Promise\Promise;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Internal\Workflow\ChildWorkflowProxy;
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

    protected function createVideoDescriptionWorkflow(): ChildWorkflowProxy
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            VideoDescriptionCreateWorkflowInterface::class
        );
    }

    protected function createVideoCreateWorkflow(): ChildWorkflowProxy
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            VideoCreateWorkflowInterface::class
        );
    }

    protected function createMediaConverterWorkflow(): ChildWorkflowProxy
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            MediaConvertWorkflowInterface::class
        );
    }

    protected function createFileDeleteWorkflow(): ChildWorkflowProxy
    {
        // @phpstan-ignore-next-line
        return Workflow::newChildWorkflowStub(
            FileDeleteWorkflowInterface::class,
        );
    }

    protected function removeSourceFile(FileGetTransfer $fileGetTransfer): Promise
    {
        $fileRemoveTransfer = new FileRemoveTransfer();
        $fileRemoveTransfer->setId($fileGetTransfer->getId());

        return $this->createFileDeleteWorkflow()->deleteFile($fileRemoveTransfer);
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
        $videoGetTransfer   = (new VideoGetTransfer())
            ->setVideoId($videoId);

        $fileGetTransfer->setId($videoId);

        try {
            /** @var FileTransfer $fileTransfer */
            $fileTransfer = yield $this->activity->lookupSourceFile($fileGetTransfer);

            $saga->addCompensation(fn () => $this->removeSourceFile($fileGetTransfer));

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

            $videoConverted = yield $this->createMediaConverterWorkflow()->convert(
                (new MediaConfigurationTransfer())
                    ->setFile($fileTransfer)
                    ->setVideo($videoTransfer)
            );

            yield $this->removeSourceFile($fileGetTransfer);

            return $videoConverted;
        } catch (\Throwable $exception) {
            yield $saga->compensate();

            throw $exception;
        }
    }
}
