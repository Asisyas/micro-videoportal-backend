<?php

namespace App\Backend\File\Business\Uploader;

use App\Shared\Generated\DTO\File\ChunkRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;

interface ChunkUploaderInterface
{
    /**
     * @param ChunkRequestTransfer $chunkRequestTransfer
     *
     * @return ChunkResponseTransfer
     */
    public function uploadChunk(ChunkRequestTransfer $chunkRequestTransfer): ChunkResponseTransfer;
}