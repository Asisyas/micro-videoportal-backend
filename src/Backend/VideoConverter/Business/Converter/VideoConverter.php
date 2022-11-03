<?php

namespace App\Backend\VideoConverter\Business\Converter;

use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Audio\SimpleFilter;
use FFMpeg\Filters\Video\FrameRateFilter;
use FFMpeg\Filters\Video\ResizeFilter;
use FFMpeg\Format\Video\WebM;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class VideoConverter implements VideoConverterInterface
{
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade
    )
    {

    }

    public function convert(VideoConvertTransfer $videoConvertTransfer): VideoConvertResultTransfer
    {
        $file = $videoConvertTransfer->getFile();
        $resolution = $videoConvertTransfer->getResolution();
        $meta = $videoConvertTransfer->getMeta();
        $metaVideo = $meta->getStreamVideo();

        $convertSource = $this->ffmpegFacade
            ->open($file->getFilePathInternal())
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

        $convertSource->save($format, '/tmp/videoportal/' . $file->getId() . '-' . $resolution->getWidth() . '.webm');

        return new VideoConvertResultTransfer();
    }
}