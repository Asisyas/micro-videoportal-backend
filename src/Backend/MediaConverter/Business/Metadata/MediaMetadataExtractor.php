<?php

namespace App\Backend\MediaConverter\Business\Metadata;

use App\Backend\MediaConverter\Business\Metadata\Expander\MetadataExpanderFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class MediaMetadataExtractor implements MediaMetadataExtractorInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param MetadataExpanderFactoryInterface $videoMetadataExpander
     * @param FilesystemFacadeInterface $filesystemFacade
     */
    public function __construct(
        private readonly FfmpegFacadeInterface            $ffmpegFacade,
        private readonly MetadataExpanderFactoryInterface $videoMetadataExpander,
        private readonly FilesystemFacadeInterface        $filesystemFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function extract(FileTransfer $fileTransfer): MediaMetadataTransfer
    {
        $streams = $this->ffmpegFacade
            ->ffprobe()
            ->streams($this->filesystemFacade->createFsOperator()->publicUrl($fileTransfer->getId()))
        ;

        $metadataTransfer = new MediaMetadataTransfer();

        foreach ($streams as $stream) {
            $this->videoMetadataExpander
                ->create()
                ->expand($metadataTransfer, $stream);
        }

        return $metadataTransfer;
    }
}