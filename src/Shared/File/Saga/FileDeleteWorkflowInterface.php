<?php

namespace App\Shared\File\Saga;

use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use Generator;
use Temporal\Workflow\WorkflowInterface;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface as MicroWorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface FileDeleteWorkflowInterface extends MicroWorkflowInterface
{
    /**
     * @param FileRemoveTransfer $fileRemoveTransfer
     *
     * @return Generator
     */
    #[WorkflowMethod(name: 'file_delete')]
    public function deleteFile(FileRemoveTransfer $fileRemoveTransfer): Generator;
}
