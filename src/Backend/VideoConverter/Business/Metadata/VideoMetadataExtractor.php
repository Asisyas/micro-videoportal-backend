<?php

namespace App\Backend\VideoConverter\Business\Metadata;

use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class VideoMetadataExtractor implements VideoMetadataExtractorInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param VideoMetadataExpanderFactoryInterface $videoMetadataExpander
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly VideoMetadataExpanderFactoryInterface $videoMetadataExpander
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
            ->streams($fileTransfer->getFilePathInternal())
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