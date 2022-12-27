<?php

namespace App\Backend\VideoPublish\Saga;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Saga\VideoPublish\VideoPropagateWorkflowInterface;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Workflow;

class VideoPropagateWorkflow implements VideoPropagateWorkflowInterface
{
    /**
     * {@inheritDoc}
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer)
    {
        $activity = Workflow::newActivityStub(
            VideoPublishActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::minute())
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)
                )
        );

        yield $activity->propagateVideo($videoGetTransfer);
    }
}
