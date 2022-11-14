<?php

namespace App\Backend\MediaConverter\Business\Metadata\Expander;

use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

interface MetadataExpanderInterface
{
    /**
     * @param MediaMetadataTransfer $metadataTransfer
     * @param Stream $stream
     * @return void
     */
    public function expand(MediaMetadataTransfer $metadataTransfer, Stream $stream): void;
}