<?php

namespace App\Backend\Video\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Video\VideoActivityInterface;
use App\Shared\Video\VideoCreateWorkflowInterface;
use Carbon\CarbonInterval;
use Generator;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;

class VideoCreateWorkflow implements VideoCreateWorkflowInterface
{
    /**
     * {@inheritDoc}
     */
    public function publishVideo(VideoPublishTransfer $videoPublishTransfer): Generator
    {
        return yield Workflow::newActivityStub(
            VideoActivityInterface::class,
            ActivityOptions::new()
                ->withScheduleToCloseTimeout(CarbonInterval::minute())
        )
            ->createVideo($videoPublishTransfer);
    }
}
