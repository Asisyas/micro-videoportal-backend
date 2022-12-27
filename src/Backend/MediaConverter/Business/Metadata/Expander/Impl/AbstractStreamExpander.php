<?php

namespace App\Backend\MediaConverter\Business\Metadata\Expander\Impl;

use App\Backend\MediaConverter\Business\Metadata\Expander\MetadataExpanderInterface;
use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\StreamTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;
use Micro\Library\DTO\Object\Collection;

abstract class AbstractStreamExpander implements MetadataExpanderInterface
{
    /**
     * @param MediaMetadataTransfer $metadataTransfer
     * @param Stream $stream
     *
     * @return void
     */
    abstract public function expand(MediaMetadataTransfer $metadataTransfer, Stream $stream): void;

    /**
     * @param MediaMetadataTransfer $metadataTransfer
     * @param Stream $stream
     *
     * @return StreamTransfer|null
     */
    protected function lookupStreamTransfer(MediaMetadataTransfer $metadataTransfer, Stream $stream): StreamTransfer|null
    {
        $streamTransfers = $metadataTransfer->getStreams() ?: [];

        $searchFlag = $stream->isVideo() ?
            MediaConverterPluginConfiguration::FLAG_VIDEO : 0;

        $searchFlag = $stream->isAudio() ?
            MediaConverterPluginConfiguration::FLAG_AUDIO : $searchFlag;

        if ($searchFlag === 0) {
            return null;
        }

        /** @var StreamTransfer $streamTransfer */
        foreach ($streamTransfers as $streamTransfer) {
            if (($streamTransfer->getMediaTypeFlag() & $searchFlag) === $searchFlag) {
                return $streamTransfer;
            }
        }

        $streamTransfer = $this->createStreamTransfer($stream);
        if (!$streamTransfer) {
            return null;
        }

        /** @var Collection<StreamTransfer>|null $streams */
        $streams = $metadataTransfer->getStreams();
        if (!$streams) {
            $metadataTransfer->setStreams([$streamTransfer]);
        } else {
            $streams->add($streamTransfer);
        }

        return $streamTransfer;
    }

    /**
     * @param Stream $stream
     *
     * @return StreamTransfer|null
     */
    protected function createStreamTransfer(Stream $stream): StreamTransfer|null
    {
        $streamTransfer = new StreamTransfer();
        $isAudio        = $stream->isAudio();
        $isVideo        = $stream->isVideo();
        $flag           = null;

        if ($isVideo) {
            $flag = MediaConverterPluginConfiguration::FLAG_VIDEO;
        }

        if ($isAudio) {
            $flag = MediaConverterPluginConfiguration::FLAG_AUDIO;
        }

        if ($flag === null) {
            return null;
        }

        return $streamTransfer
            ->setMediaTypeFlag($flag);
    }
}
