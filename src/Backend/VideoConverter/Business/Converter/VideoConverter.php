<?php

namespace App\Backend\VideoConverter\Business\Converter;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use FFMpeg\Coordinate\AspectRatio;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\FrameRate;
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
    public function convert(FileTransfer $fileTransfer, ResolutionTransfer $resolutionTransfer): VideoConvertResultTransfer
    {

        $convertSource = $this->ffmpegFacade
            ->open($this->filesystemOperator->publicUrl($fileTransfer->getId()))
            ->addFilter(
                new SimpleFilter([
                    '-an'
                ])
            );
        $filters = $convertSource->filters();
        $filters->resize(new Dimension(
            $resolutionTransfer->getWidth(),
            $resolutionTransfer->getHeight()
            ),ResizeFilter::RESIZEMODE_INSET, false)
        ;
        $filters->framerate(new FrameRate($resolutionTransfer->getFrameRate()), 0.5);
        $filters->synchronize();

        $format = new WebM('libvorbis', 'libvpx-vp9');
        $format->setKiloBitrate($resolutionTransfer->getBitRate());

        $tmpFileResource = tmpfile();
        $tempPointer = stream_get_meta_data($tmpFileResource);
        $tempFileDest = $tempPointer['uri'];
        $convertSource->save($format, $tempFileDest);

        $this->filesystemOperator->writeStream($fileTransfer->getId() . '_' . $resolutionTransfer->getHeight() . '.webm', $tmpFileResource);

        return new VideoConvertResultTransfer();
    }
}