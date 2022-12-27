<?php

namespace App\Backend\MediaConverter\Facade;

use App\Backend\MediaConverter\Business\Configuration\Media\MediaResolutionsCalculatorFactory;
use App\Backend\MediaConverter\Business\Configuration\Media\MediaResolutionsCalculatorFactoryInterface;
use App\Backend\MediaConverter\Business\Converter\ConverterFactoryInterface;
use App\Backend\MediaConverter\Business\Dash\DashManifestGeneratorFactoryInterface;
use App\Backend\MediaConverter\Business\Metadata\MediaMetadataExtractorFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;

class MediaConverterFacade implements MediaConverterFacadeInterface
{
    /**
     * @param MediaMetadataExtractorFactoryInterface $mediaMetadataExtractorFactory
     * @param ConverterFactoryInterface $mediaConverterFactory
     * @param MediaResolutionsCalculatorFactoryInterface $mediaResolutionsCalculatorFactory
     * @param DashManifestGeneratorFactoryInterface $dashGeneratorFactory
     */
    public function __construct(
        private readonly MediaMetadataExtractorFactoryInterface $mediaMetadataExtractorFactory,
        private readonly ConverterFactoryInterface              $mediaConverterFactory,
        private readonly MediaResolutionsCalculatorFactoryInterface      $mediaResolutionsCalculatorFactory,
        private readonly DashManifestGeneratorFactoryInterface $dashGeneratorFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function extractMediaMetadata(FileTransfer $fileTransfer): MediaMetadataTransfer
    {
        return $this->mediaMetadataExtractorFactory
            ->create()
            ->extract($fileTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer, callable $progressListener = null): MediaConvertedResultTransfer
    {
        return $this->mediaConverterFactory
            ->create()
            ->convert($mediaConfigurationTransfer, $progressListener);
    }

    /**
     * {@inheritDoc}
     */
    public function calculateMediaResolutions(MediaMetadataTransfer $videoMetadataTransfer): MediaResolutionCollectionTransfer
    {
        return $this->mediaResolutionsCalculatorFactory
            ->create()
            ->calculate($videoMetadataTransfer);
    }

    /**
     * @param MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer
     *
     * @return DashManifestTransfer
     */
    public function generateDashManifest(MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer): DashManifestTransfer
    {
        return $this->dashGeneratorFactory
            ->create()
            ->generate($convertedResultCollectionTransfer);
    }
}
