<?php

namespace App\Client\File\Uploader;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

interface FileUploaderInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function uploadFromStream(FileUploadTransfer $fileUploadTransfer): FileTransfer;
}