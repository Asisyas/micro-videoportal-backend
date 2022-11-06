<?php

namespace App\Saga\VideoPublish\Workflow;

use App\Saga\VideoPublish\Activity\VideoPublishActivityInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
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

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(
            VideoPublishActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::hour(1))
                ->withRetryOptions(RetryOptions::new()->withMaximumAttempts(1))
        );
    }

    #[Workflow\WorkflowMethod("VideoPublish")]
    public function publish(FileGetTransfer $fileGetTransfer)
    {
        $saga = new Saga();
        $saga->setParallelCompensation(true);

        try {
            $fileTransfer = yield $this->activity->lookupSourceFile($fileGetTransfer);
            $videoMetadata = yield $this->activity->extractVideoMetadata($fileTransfer);
            $resolutions = yield $this->activity->calculateVideoResolutions($videoMetadata);
            foreach ($resolutions->getResolutions() as $resolution) {
                yield $this->activity->convertVideo($fileTransfer, $resolution);
            }

            return 'CONVERTED!';

        } catch (\Throwable $exception) {
            $saga->compensate();

            throw $exception;
        }
    }
}