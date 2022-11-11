<?php

namespace App\Saga\VideoPublish\Workflow;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\VideoConverter\PublishStatusTransfer;
use Temporal\Workflow\QueryMethod;
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
    #[WorkflowMethod("VideoPublish")]
    public function publish(FileGetTransfer $fileGetTransfer);

    #[QueryMethod(name: 'getStatus')]
    public function lookupStatus(): PublishStatusTransfer;
}