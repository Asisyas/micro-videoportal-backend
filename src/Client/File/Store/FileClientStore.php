<?php

namespace App\Client\File\Store;

use App\Shared\File\Saga\FileCreateWorkflowInterface;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Temporal\Client\WorkflowClientInterface;

class FileClientStore implements FileClientStoreInterface
{
    /**
     * @param WorkflowClientInterface $workflowClient
     */
    public function __construct(
        private readonly WorkflowClientInterface $workflowClient
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        // @phpstan-ignore-next-line
        return $this->workflowClient
            ->newWorkflowStub(FileCreateWorkflowInterface::class)
            ->createFile($fileUploadTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteFile(FileRemoveTransfer $fileRemoveTransfer): bool
    {
        return true;
    }
}
