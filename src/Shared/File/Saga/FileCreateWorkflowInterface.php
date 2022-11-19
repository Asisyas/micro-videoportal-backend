<?php

namespace App\Shared\File\Saga;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Temporal\Workflow\WorkflowInterface;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface as MicroWorkflowInterface;
use \Generator;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface FileCreateWorkflowInterface extends MicroWorkflowInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return Generator<FileTransfer>
     */
    #[WorkflowMethod(name: 'file_create')]
    public function createFile(FileUploadTransfer $fileUploadTransfer): Generator;
}