<?php

namespace App\Backend\File\Facade;

use App\Backend\File\Business\File\Manager\FileManagerFactoryInterface;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

class FileFacade implements FileFacadeInterface
{
    /**
     * @param FileManagerFactoryInterface $fileManagerFactory
     */
    public function __construct(private readonly FileManagerFactoryInterface $fileManagerFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        return $this->fileManagerFactory
            ->create()
            ->createFile($fileUploadTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function removeFile(FileRemoveTransfer $fileRemoveTransfer): void
    {
        $this->fileManagerFactory->create()->deleteFile($fileRemoveTransfer);
    }
}
