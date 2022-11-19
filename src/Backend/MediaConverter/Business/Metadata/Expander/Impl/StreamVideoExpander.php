<?php

namespace App\Backend\MediaConverter\Business\Metadata\Expander\Impl;

use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

class StreamVideoExpander extends AbstractStreamExpander
{
    /**
     * {@inheritDoc}
     */
    public function expand(MediaMetadataTransfer $metadataTransfer, Stream $stream): void
    {
        if(!$stream->isVideo()) {
            return;
        }

        $streamTransfer = $this->lookupStreamTransfer($metadataTransfer, $stream);

        $rate = explode('/', $stream->get('r_frame_rate'));

        $streamTransfer
            ->setFrameRate((int) $rate[0] / (int) $rate[1])
            ->setWidth((int) $stream->get('width'))
            ->setHeight((int) $stream->get('height'))
            ->setDuration($stream->get('duration'))
        ;

        if($this->isHdr($stream)) {
            $streamTransfer->setMediaTypeFlag(MediaConverterPluginConfiguration::FLAG_HDR);
        }

        $streamTransfer->setRotation($this->getRotation($stream));
    }

    protected function getRotation(Stream $stream): int
    {
        $tags = $stream->get('tags');
        if(!$tags) {
            return 0;
        }

        return $tags['rotate'] ?? 0;
    }

    /**
     * @param Stream $stream
     *
     * @return bool
     */
    protected function isHdr(Stream $stream): bool
    {
        $colorSpace = $stream->get('color_space');
        $colorTrans = $stream->get('color_transfer');
        $colorPrimaries = $stream->get('color_primaries');

        return
            $colorSpace === 'bt2020nc' ||
            $colorTrans === 'smpte2084' ||
            $colorPrimaries === 'bt2020';
    }
}