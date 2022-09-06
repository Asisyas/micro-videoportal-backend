<?php

namespace App\Backend\File\Facade;

use App\Shared\Generated\DTO\File\ChunkRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\StreamTransfer;

interface FileFacadeInterface
{
    /**
     * @param FileCreateTransfer $fileCreateTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileTransfer;

    /**
     * @param ChunkRequestTransfer $chunkRequestTransfer
     *
     * @return ChunkResponseTransfer
     */
    public function uploadFile(ChunkRequestTransfer $chunkRequestTransfer): ChunkResponseTransfer;
}