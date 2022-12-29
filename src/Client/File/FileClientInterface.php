<?php

namespace App\Client\File;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

interface FileClientInterface
{


    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     */
    public function lookupFile(FileGetTransfer $fileGetTransfer): FileTransfer;

    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function uploadFile(FileUploadTransfer $fileUploadTransfer): FileTransfer;
}
