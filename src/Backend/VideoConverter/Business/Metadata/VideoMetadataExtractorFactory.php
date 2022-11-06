<?php

namespace App\Backend\VideoConverter\Business\Metadata;

use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderFactoryInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class VideoMetadataExtractorFactory implements VideoMetadataExtractorFactoryInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param VideoMetadataExpanderFactoryInterface $videoMetadataExpanderFactory
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly VideoMetadataExpanderFactoryInterface $videoMetadataExpanderFactory,
        private readonly FilesystemFacadeInterface $filesystemFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoMetadataExtractorInterface
    {
        return new VideoMetadataExtractor(
            $this->ffmpegFacade,
            $this->videoMetadataExpanderFactory,
            $this->filesystemFacade
        );
    }
}