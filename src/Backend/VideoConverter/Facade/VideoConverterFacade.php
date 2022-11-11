<?php

namespace App\Backend\VideoConverter\Facade;

use App\Backend\VideoConverter\Business\Configuration\Video\VideoResolutionsCalculatorFactory;
use App\Backend\VideoConverter\Business\Converter\VideoConverterFactoryInterface;
use App\Backend\VideoConverter\Business\Metadata\VideoMetadataExtractorFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionSimpleTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\ResolutionCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

class VideoConverterFacade implements VideoConverterFacadeInterface
{
    public function __construct(
        private readonly VideoMetadataExtractorFactoryInterface $videoMetadataExtractorFactory,
        private readonly VideoConverterFactoryInterface $videoConverterFactory,
        private readonly VideoResolutionsCalculatorFactory $videoResolutionsCalculatorFactory
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
    public function convertVideo(FileTransfer $fileTransfer, ResolutionTransfer $resolutionTransfer): ResolutionSimpleTransfer
    {
        return $this
            ->videoConverterFactory
            ->create()
            ->convert($fileTransfer, $resolutionTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function calculateVideoResolutions(VideoMetadataTransfer $videoMetadataTransfer): ResolutionCollectionTransfer
    {
        return $this->videoResolutionsCalculatorFactory
            ->create()
            ->calculate($videoMetadataTransfer);
    }
}