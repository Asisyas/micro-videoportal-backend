<?php

namespace App\Backend\File\Business\Uploader;

use App\Shared\Generated\DTO\File\ChunkRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;

class ChunkUploader implements ChunkUploaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function uploadChunk(ChunkRequestTransfer $chunkRequestTransfer): ChunkResponseTransfer
    {
        $channelId = $chunkRequestTransfer->getChannel();
        $blob = $chunkRequestTransfer->getBlob();
        $offset = $chunkRequestTransfer->getOffset();
        $size = $chunkRequestTransfer->getSize();

        $response = new ChunkResponseTransfer();
        $response->setSizeLoaded();
        $response->setSizeRemaining();

        return $response;
    }
}