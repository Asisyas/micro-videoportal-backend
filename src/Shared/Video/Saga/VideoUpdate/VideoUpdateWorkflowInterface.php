<?php

namespace App\Shared\Video\Saga\VideoUpdate;

use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoUpdateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return VideoTransfer
     */
    #[WorkflowMethod("VideoUpdate")]
    public function updateVideo(VideoTransfer $videoTransfer);
}