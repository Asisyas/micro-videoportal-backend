<?php

namespace App\Backend\VideoConverter\Business\Metadata\Expander\Impl;

use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderInterface;
use App\Shared\Generated\DTO\VideoConverter\StreamVideoTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

class StreamVideoExpander implements VideoMetadataExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(VideoMetadataTransfer $metadataTransfer, Stream $stream): void
    {
        if(!$stream->isVideo()) {
            return;
        }

        $streamTransfer = new StreamVideoTransfer();

        $rate = explode('/', $stream->get('r_frame_rate'));

        $streamTransfer
            ->setFrameRate((int)$rate)
            ->setBitRate($stream->get('bit_rate'))
            ->setCodec($stream->get('codec_name'))
            ->setWidth($stream->get('width'))
            ->setHeight($stream->get('height'))
            ->setDuration($stream->get('duration'));

        $metadataTransfer->setStreamVideo($streamTransfer);
    }
}