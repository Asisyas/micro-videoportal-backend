<?php

namespace App\Backend\File\Business\File\Storage;

use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

interface FileStorageInterface
{
    /**
     * @param FileTransfer $fileTransfer
     *
     * @return void
     */
    public function put(FileTransfer $fileTransfer): void;

    /**
     * @param FileRemoveTransfer $fileRemoveTransfer
     *
     * @return void
     */
    public function remove(FileRemoveTransfer $fileRemoveTransfer): void;
}
