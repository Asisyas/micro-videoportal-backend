<?php

namespace App\Backend\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Video\Saga\VideoActivityInterface;
use App\Shared\Video\Saga\VideoUpdateSrcWorkflowInterface;
use Temporal\Workflow;
use Generator;

class VideoUpdateSrcWorkflow implements VideoUpdateSrcWorkflowInterface
{
    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): Generator
    {
        yield Workflow::newActivityStub(VideoActivityInterface::class)
            ->updateVideoSrc($videoSrcSetTransfer);
    }
}