<?php

namespace App\Backend\VideoConverter\Facade;

use App\Backend\VideoConverter\Business\Converter\VideoConverterFactoryInterface;
use App\Backend\VideoConverter\Business\Metadata\VideoMetadataExtractorFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

class VideoConverterFacade implements VideoConverterFacadeInterface
{

    public function __construct(
        private readonly VideoMetadataExtractorFactoryInterface $videoMetadataExtractorFactory,
        private readonly VideoConverterFactoryInterface $videoConverterFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function extractVideoMetadata(FileTransfer $fileTransfer): VideoMetadataTransfer
    {
        return $this->videoMetadataExtractorFactory
            ->create()
            ->extract($fileTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function convertVideo(VideoConvertTransfer $videoConvertTransfer): VideoConvertResultTransfer
    {
        return $this
            ->videoConverterFactory
            ->create()
            ->convert($videoConvertTransfer);
    }
}