<?php

namespace App\Client\File;

use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\StreamGetTransfer;
use App\Shared\Generated\DTO\File\StreamTransfer;


interface FileClientInterface
{
    /**
     * @param FileCreateTransfer $streamCreateTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileTransfer;

    /**
     * @param StreamGetTransfer $streamGetTransfer
     *
     * @return StreamTransfer
     */
    public function getStream(StreamGetTransfer $streamGetTransfer): StreamTransfer;
}