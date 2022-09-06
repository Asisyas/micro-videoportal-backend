<?php

namespace App\Client\File\Uploader;

use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkTransfer;

interface FileUploaderInterface
{
    /**
     * @param ChunkTransfer $chunkTransfer
     *
     * @return ChunkResponseTransfer
     */
    public function upload(ChunkTransfer $chunkTransfer): ChunkResponseTransfer;
}