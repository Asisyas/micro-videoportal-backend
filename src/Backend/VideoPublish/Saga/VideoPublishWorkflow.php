<?php

namespace App\Backend\VideoPublish\Saga;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\MediaConverter\Saga\MediaConvertWorkflowInterface;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;
use App\Shared\Saga\VideoPublish\VideoPublishWorkflowInterface;
use App\Shared\Video\Saga\VideoCreateWorkflowInterface;
use App\Shared\VideoDescription\Saga\VideoDescriptionCreateWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Internal\Workflow\ChildWorkflowProxy;
use Temporal\Workflow;
use Temporal\Workflow\Saga;

class VideoPublishWorkflow implements VideoPublishWorkflowInterface
{
    private ActivityProxy $activity;

    private readonly ChildWorkflowProxy $workflowVideoDescriptionCreate;

    private readonly ChildWorkflowProxy $workflowVideoCreate;

    private readonly ChildWorkflowProxy $workflowMediaConverter;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(
            VideoPublishActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::hour(24))
                ->withHeartbeatTimeout(CarbonInterval::minute(10))
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)

            )
        );
    }

    /**
     * @return VideoDescriptionCreateWorkflowInterface
     */
    protected function createVideoDescriptionWorkflow(): ChildWorkflowProxy
    {
        return Workflow::newChildWorkflowStub(
            VideoDescriptionCreateWorkflowInterface::class
        );
    }

    /**
     * @return VideoCreateWorkflowInterface
     */
    protected function createVideoCreateWorkflow(): ChildWorkflowProxy
    {
        return Workflow::newChildWorkflowStub(
            VideoCreateWorkflowInterface::class
        );
    }

    /**
     * @return MediaConvertWorkflowInterface
     */
    protected function createMediaConverterWorkflow(): ChildWorkflowProxy
    {
        return Workflow::newChildWorkflowStub(
            MediaConvertWorkflowInterface::class
        );
    }

    /**
     * {@inheritDoc}
     */
    #[Workflow\WorkflowMethod("VideoPublish")]
    public function publish(FileGetTransfer $fileGetTransfer)
    {
        $saga = new Saga();
        $saga->setParallelCompensation(true);
        $videoGetTransfer = (new VideoGetTransfer())
            ->setVideoId($fileGetTransfer->getId());

        try {
            /** @var FileTransfer $fileTransfer */
            $fileTransfer = yield $this->activity->lookupSourceFile($fileGetTransfer);

            /** @var VideoTransfer $videoTransfer */
            $videoTransfer = yield $this
                ->createVideoCreateWorkflow()
                ->createVideo((new VideoCreateTransfer())->setVideoId($fileTransfer->getId())
            );

            yield $this
                ->createVideoDescriptionWorkflow()
                ->create((new VideoDescriptionPutTransfer())
                    ->setVideoId($videoTransfer->getId())
                    ->setSource((new VideoDescriptionTransfer())->setTitle($fileTransfer->getName()))
            );

            yield $this->activity->propagateVideo($videoGetTransfer);

            $videoConverted = yield $this->createMediaConverterWorkflow()->convert(
                (new MediaConfigurationTransfer())
                    ->setFile($fileTransfer)
                    ->setVideo($videoTransfer)
            );

           // yield $this->activity->propagateVideo($videoGetTransfer);

            return $videoConverted;

        } catch (\Throwable $exception) {
            $saga->compensate();

            throw $exception;
        }
    }
}