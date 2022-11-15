<?php

namespace App\Shared\Saga\VideoPublish;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
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
    public function lookupStatus(): MediaConvertedResultCollectionTransfer;
}