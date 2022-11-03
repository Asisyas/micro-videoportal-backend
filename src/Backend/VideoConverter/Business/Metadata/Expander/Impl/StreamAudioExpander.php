<?php

namespace App\Backend\VideoConverter\Business\Metadata\Expander\Impl;

use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderInterface;
use App\Shared\Generated\DTO\VideoConverter\StreamAudioTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

class StreamAudioExpander implements VideoMetadataExpanderInterface
{

    public function expand(VideoMetadataTransfer $metadataTransfer, Stream $stream): void
    {
        if(!$stream->isAudio()) {
            return;
        }

        $streamTransfer = new StreamAudioTransfer();

        $streamTransfer
            ->setCodec($stream->get('codec_name'))
            ->setRate((int) $stream->get('bit_rate'))
            ->setChannelCount((int) $stream->get('channels'))
            ->setChannelLayout($stream->get('channel_layout'))
        ;

        $metadataTransfer->setStreamAudio($streamTransfer);
    }
}