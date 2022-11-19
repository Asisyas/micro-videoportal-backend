<?php

namespace App\Backend\File\Facade;

use App\Backend\File\Business\File\Factory\FileFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

class FileFacade implements FileFacadeInterface
{
    /**
     * @param FileFactoryInterface $fileFactory]
     */
    public function __construct(private readonly FileFactoryInterface $fileFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        return $this->fileFactory->create($fileUploadTransfer);
    }
}