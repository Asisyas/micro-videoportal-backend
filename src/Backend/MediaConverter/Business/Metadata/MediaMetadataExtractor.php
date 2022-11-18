<?php

namespace App\Backend\MediaConverter\Business\Metadata;

use App\Backend\MediaConverter\Business\Metadata\Expander\MetadataExpanderFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class MediaMetadataExtractor implements MediaMetadataExtractorInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param MetadataExpanderFactoryInterface $videoMetadataExpander
     * @param FilesystemOperator $filesystem
     */
    public function __construct(
        private readonly FfmpegFacadeInterface            $ffmpegFacade,
        private readonly MetadataExpanderFactoryInterface $videoMetadataExpander,
        private readonly FilesystemOperator               $filesystem
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
            ->streams($this->filesystem->publicUrl($fileTransfer->getId()))
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