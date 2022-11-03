<?php

namespace App\Backend\VideoConverter\Business\Metadata\Expander;

use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

interface VideoMetadataExpanderInterface
{
    /**
     * @param VideoMetadataTransfer $metadataTransfer
     * @param Stream $stream
     * @return void
     */
    public function expand(VideoMetadataTransfer $metadataTransfer, Stream $stream): void;
}