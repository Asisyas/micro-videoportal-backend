<?php

namespace App\Backend\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Video\Saga\VideoActivityInterface;
use App\Shared\Video\Saga\VideoUpdateSrcWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Client\WorkflowOptions;
use Temporal\Workflow;
use Generator;

class VideoUpdateSrcWorkflow implements VideoUpdateSrcWorkflowInterface
{
    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer)
    {
        yield Workflow::newActivityStub(
            VideoActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(
                    CarbonInterval::minute(20)
                )
        )
            ->updateVideoSrc($videoSrcSetTransfer);
    }
}