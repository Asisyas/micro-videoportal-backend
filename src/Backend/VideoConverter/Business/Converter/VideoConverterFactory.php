<?php

namespace App\Backend\VideoConverter\Business\Converter;

use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class VideoConverterFactory implements VideoConverterFactoryInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade
    )
    {
    }

    /**
     * @return VideoConverterInterface
     */
    public function create(): VideoConverterInterface
    {
        return new VideoConverter(
            $this->ffmpegFacade
        );
    }
}