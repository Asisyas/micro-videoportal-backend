<?php

namespace App\Backend\VideoConverter\Business\Converter;

use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Audio\SimpleFilter;
use FFMpeg\Filters\Video\ResizeFilter;
use FFMpeg\Format\Video\WebM;
use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class VideoConverter implements VideoConverterInterface
{
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly FilesystemOperator $filesystemOperator
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function convert(VideoConvertTransfer $videoConvertTransfer): VideoConvertResultTransfer
    {
        $file = $videoConvertTransfer->getFile();
        $resolution = $videoConvertTransfer->getResolution();

        $convertSource = $this->ffmpegFacade
            ->open($this->filesystemOperator->publicUrl($file->getId()))
            ->addFilter(
                new SimpleFilter([
                    '-an'
                ])
            );
        $filters = $convertSource->filters();
        $filters->resize(new Dimension(
                    $resolution->getWidth(),
                    $resolution->getHeight()
                ),ResizeFilter::RESIZEMODE_INSET, false)
        ;
        $filters->synchronize();

        $format = new WebM('libvorbis', 'libvpx-vp9');
        $format->setKiloBitrate(6000);

        $tempPointer = tmpfile();
        $convertSource->save($format, $tempPointer);

        $stream = fopen($tempPointer, 'r');
        $this->filesystemOperator->writeStream($file->getId() . '_' . $resolution->getHeight() . 'webm', $stream);

        return new VideoConvertResultTransfer();
    }
}