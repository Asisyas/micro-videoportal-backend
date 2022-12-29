<?php

namespace App\Client\File\Reader;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

interface FileClientReaderInterface
{
    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     *
     * @throws NotFoundException
     */
    public function lookup(FileGetTransfer $fileGetTransfer): FileTransfer;
}
