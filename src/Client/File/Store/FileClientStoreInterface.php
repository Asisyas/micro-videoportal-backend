<?php

namespace App\Client\File\Store;

use App\Shared\Generated\DTO\File\FileCreatedTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

interface FileClientStoreInterface
{
    /**
     * @param FileCreateTransfer $fileCreateTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileCreatedTransfer;
}