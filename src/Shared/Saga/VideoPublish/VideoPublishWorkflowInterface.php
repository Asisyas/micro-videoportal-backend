<?php

namespace App\Shared\Saga\VideoPublish;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface as MicroWorkflowInterface;

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
