<?php

namespace App\Backend\VideoConverter\Business\Metadata;

use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderFactoryInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class VideoMetadataExtractorFactory implements VideoMetadataExtractorFactoryInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param VideoMetadataExpanderFactoryInterface $videoMetadataExpanderFactory
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly VideoMetadataExpanderFactoryInterface $videoMetadataExpanderFactory
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
            $this->videoMetadataExpanderFactory
        );
    }
}