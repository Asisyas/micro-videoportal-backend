<?php

namespace App\Client\File\Client;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

interface ClientFileInterface
{
    /**
     * @param FileRemoveTransfer $fileRemoveTransfer
     *
     * @return void
     */
    public function deleteFile(FileRemoveTransfer $fileRemoveTransfer): void;

    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     *
     * @throws NotFoundException
     */
    public function lookupFile(FileGetTransfer $fileGetTransfer): FileTransfer;

    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function uploadFile(FileUploadTransfer $fileUploadTransfer): FileTransfer;
}
