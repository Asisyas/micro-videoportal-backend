<?php

namespace App\Shared\Saga\VideoCreate;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoCreateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    #[WorkflowMethod("VideoCreate")]
    public function createVideo(VideoCreateTransfer $videoCreateTransfer);
}