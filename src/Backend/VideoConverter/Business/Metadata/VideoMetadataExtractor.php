<?php

namespace App\Backend\VideoConverter\Business\Metadata;

use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class VideoMetadataExtractor implements VideoMetadataExtractorInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param VideoMetadataExpanderFactoryInterface $videoMetadataExpander
     * @param FilesystemFacadeInterface $filesystemFacade
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly VideoMetadataExpanderFactoryInterface $videoMetadataExpander,
        private readonly FilesystemFacadeInterface $filesystemFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function extract(FileTransfer $fileTransfer): VideoMetadataTransfer
    {
        $streams = $this->ffmpegFacade
            ->ffprobe()
            ->streams($this->filesystemFacade->createFsOperator()->publicUrl($fileTransfer->getId()))
        ;

        $metadataTransfer = new VideoMetadataTransfer();

        foreach ($streams as $stream) {
            $this->videoMetadataExpander
                ->create()
                ->expand($metadataTransfer, $stream);
        }

        return $metadataTransfer;
    }
}