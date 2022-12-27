<?php

namespace App\Backend\MediaConverter\Business\Metadata;

use App\Backend\MediaConverter\Business\Metadata\Expander\MetadataExpanderFactoryInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class MediaMetadataExtractorFactory implements MediaMetadataExtractorFactoryInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param MetadataExpanderFactoryInterface $videoMetadataExpanderFactory
     * @param FilesystemFacadeInterface $filesystemFacade
     */
    public function __construct(
        private readonly FfmpegFacadeInterface            $ffmpegFacade,
        private readonly MetadataExpanderFactoryInterface $videoMetadataExpanderFactory,
        private readonly FilesystemFacadeInterface        $filesystemFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): MediaMetadataExtractorInterface
    {
        return new MediaMetadataExtractor(
            $this->ffmpegFacade,
            $this->videoMetadataExpanderFactory,
            $this->filesystemFacade->createFsOperator()
        );
    }
}
