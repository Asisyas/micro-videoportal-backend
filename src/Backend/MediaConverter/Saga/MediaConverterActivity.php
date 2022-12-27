<?php

namespace App\Backend\MediaConverter\Saga;

use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;
use App\Shared\MediaConverter\Saga\MediaConvertActivityInterface;
use Temporal\Activity;

class MediaConverterActivity implements MediaConvertActivityInterface
{
    /**
     * @param MediaConverterFacadeInterface $mediaConverterFacade
     */
    public function __construct(
        private readonly MediaConverterFacadeInterface $mediaConverterFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer): MediaConvertedResultTransfer
    {
        return $this->mediaConverterFacade->convert($mediaConfigurationTransfer, function (float $percentage) {
            Activity::heartbeat($percentage);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function extractMediaMetadata(FileTransfer $fileTransfer): MediaMetadataTransfer
    {
        return $this->mediaConverterFacade->extractMediaMetadata($fileTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function calculateMediaResolutions(MediaMetadataTransfer $videoMetadataTransfer): MediaResolutionCollectionTransfer
    {
        return $this->mediaConverterFacade->calculateMediaResolutions($videoMetadataTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function generateDashManifest(MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer): DashManifestTransfer
    {
        return $this->mediaConverterFacade->generateDashManifest($convertedResultCollectionTransfer);
    }
}
