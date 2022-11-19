<?php

namespace App\Backend\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Video\Saga\VideoActivityInterface;
use App\Shared\Video\Saga\VideoCreateWorkflowInterface;
use Carbon\CarbonInterval;
use Generator;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;

class VideoCreateWorkflow implements VideoCreateWorkflowInterface
{
    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): Generator
    {
        return yield Workflow::newActivityStub(VideoActivityInterface::class,
            ActivityOptions::new()
                ->withScheduleToCloseTimeout(CarbonInterval::minute())
        )
            ->createVideo($videoCreateTransfer);
    }
}