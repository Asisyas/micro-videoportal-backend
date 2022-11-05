<?php

namespace App\Backend\VideoConverter\Business\Converter;

use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class VideoConverterFactory implements VideoConverterFactoryInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param FilesystemFacadeInterface $filesystemFacade
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly FilesystemFacadeInterface $filesystemFacade
    )
    {
    }

    /**
     * @return VideoConverterInterface
     */
    public function create(): VideoConverterInterface
    {
        return new VideoConverter(
            $this->ffmpegFacade,
            $this->filesystemFacade->createFsOperator(),
        );
    }
}