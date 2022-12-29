<?php

namespace App\Backend\File\Facade;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

interface FileFacadeInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer;

    /**
     * @param FileRemoveTransfer $fileRemoveTransfer
     *
     * @return void
     */
    public function removeFile(FileRemoveTransfer $fileRemoveTransfer): void;
}
