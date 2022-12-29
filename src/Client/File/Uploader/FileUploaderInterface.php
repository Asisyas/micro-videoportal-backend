<?php

namespace App\Client\File\Uploader;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use League\Flysystem\FilesystemException;

interface FileUploaderInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     *
     * @throws FilesystemException
     */
    public function uploadFromStream(FileUploadTransfer $fileUploadTransfer): FileTransfer;
}
