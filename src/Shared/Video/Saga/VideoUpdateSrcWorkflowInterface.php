<?php

namespace App\Shared\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;
use Generator;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowInterface as TemporalWorkflow;

#[TemporalWorkflow]
interface VideoUpdateSrcWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoSrcSetTransfer $videoSrcSetTransfer
     *
     * @return Generator
     *
     * @throws VideoNotFoundException
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): Generator;
}