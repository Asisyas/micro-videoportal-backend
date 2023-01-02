<?php

namespace App\Shared\Video;

use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowInterface as TemporalWorkflow;
use Temporal\Workflow\WorkflowMethod;

#[TemporalWorkflow]
interface VideoUpdateSrcWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoSrcSetTransfer $videoSrcSetTransfer
     *
     * @throws VideoNotFoundException
     */
    #[WorkflowMethod(name: 'Video_Src_Update')] // @phpstan-ignore-line
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer);
}
