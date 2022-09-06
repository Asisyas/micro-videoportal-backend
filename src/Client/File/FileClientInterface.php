<?php

namespace App\Client\File;

use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;


interface FileClientInterface
{
    /**
     * @param FileCreateTransfer $streamCreateTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileTransfer;

    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     */
    public function lookupFile(FileGetTransfer $fileGetTransfer): FileTransfer;

    /**
     * @param ChunkTransfer $chunkTransfer
     *
     * @return ChunkResponseTransfer
     */
    public function uploadFile(ChunkTransfer $chunkTransfer): ChunkResponseTransfer;
}