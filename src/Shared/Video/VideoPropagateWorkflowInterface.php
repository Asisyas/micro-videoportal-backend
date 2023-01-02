<?php

namespace App\Shared\Video;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoPropagateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return mixed
     */
    #[WorkflowMethod(name: 'Video_Index_Propagate')]
    public function propagateVideo(VideoGetTransfer $videoGetTransfer);
}
