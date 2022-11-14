<?php

namespace App\Backend\MediaConverter\Business\Metadata\Expander\Impl;

use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

class DefaultsExpander extends AbstractStreamExpander
{
    /**
     * @param MediaMetadataTransfer $metadataTransfer
     * @param Stream $stream
     *
     * @return void
     */
    public function expand(MediaMetadataTransfer $metadataTransfer, Stream $stream): void
    {
        $streamTransfer = $this->lookupStreamTransfer($metadataTransfer, $stream);
        if(!$streamTransfer) {
            return;
        }

        $streamTransfer
            ->setBitRate($stream->get('bit_rate') / 1000)
            ->setCodec($stream->get('codec_name'))
            ->setChannelCount((int) $stream->get('channels'))
            ->setChannelLayout($stream->get('channel_layout'))
        ;
    }
}