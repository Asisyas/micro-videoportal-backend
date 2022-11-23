<?php

namespace App\Backend\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
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
    public function publishVideo(VideoPublishTransfer $videoPublishTransfer): Generator
    {
        return yield Workflow::newActivityStub(VideoActivityInterface::class,
            ActivityOptions::new()
                ->withScheduleToCloseTimeout(CarbonInterval::minute())
        )
            ->createVideo($videoPublishTransfer);
    }
}