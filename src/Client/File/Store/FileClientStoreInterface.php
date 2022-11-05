<?php

namespace App\Client\File\Store;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

interface FileClientStoreInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer;
}