<?php

namespace App\Shared\Video;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface as MicroWorkflowInterface;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface VideoPublishWorkflowInterface extends MicroWorkflowInterface
{
    /**
     * @param VideoPublishTransfer $videoPublishTransfer
     *
     * @return mixed
     */
    #[WorkflowMethod("Video_Publish")]
    public function publish(VideoPublishTransfer $videoPublishTransfer);
}
