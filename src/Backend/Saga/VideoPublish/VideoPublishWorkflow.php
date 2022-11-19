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
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\MediaConverter\Saga\MediaConvertActivityInterface;
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
use Temporal\Promise;
use Temporal\Workflow;
use Temporal\Workflow\Saga;

class VideoPublishWorkflow implements VideoPublishWorkflowInterface
{
    /** @var VideoPublishActivityInterface */
    private ActivityProxy $activity;

    private readonly ChildWorkflowProxy $workflowVideoDescriptionCreate;

    private readonly ChildWorkflowProxy $workflowVideoCreate;

    private readonly ChildWorkflowProxy $workflowMediaConverter;

    /** @var MediaConvertedResultCollectionTransfer  */
    private MediaConvertedResultCollectionTransfer $convertedResultCollection;

    private bool $convertedFinish = false;

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

        $this->workflowVideoDescriptionCreate = Workflow::newChildWorkflowStub(
            VideoDescriptionCreateWorkflowInterface::class
        );

        $this->workflowVideoCreate = Workflow::newChildWorkflowStub(
            VideoCreateWorkflowInterface::class
        );

        $this->workflowMediaConverter = Workflow::newChildWorkflowStub(
            MediaConvertWorkflowInterface::class
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

            /** @var VideoTransfer $videoTransfer */
            $videoTransfer = yield $this->workflowVideoCreate->createVideo(
                (new VideoCreateTransfer())
                    ->setVideoId($fileTransfer->getId())
            );

            yield $this->workflowVideoDescriptionCreate->create((new VideoDescriptionTransfer)
                ->setVideoId($videoTransfer->getId())
                ->setTitle($fileTransfer->getName())
            );

            return yield $this->workflowMediaConverter->convert(
                (new MediaConfigurationTransfer())
                    ->setFile($fileTransfer)
                    ->setVideo($videoTransfer)
            );

        } catch (\Throwable $exception) {
            $saga->compensate();

            throw $exception;
        }
    }
}