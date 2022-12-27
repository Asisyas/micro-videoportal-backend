<?php

namespace App\Client\File\Reader;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

interface FileClientReaderInterface
{
    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     */
    public function lookup(FileGetTransfer $fileGetTransfer): FileTransfer;
}
