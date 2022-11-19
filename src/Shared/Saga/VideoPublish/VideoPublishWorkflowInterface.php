<?php

namespace App\Shared\Saga\VideoPublish;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface as MicroWorkflowInterface;

#[WorkflowInterface]
interface VideoPublishWorkflowInterface extends MicroWorkflowInterface
{
    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return mixed
     */
    #[WorkflowMethod("Video_Publish")]
    public function publish(FileGetTransfer $fileGetTransfer);
}