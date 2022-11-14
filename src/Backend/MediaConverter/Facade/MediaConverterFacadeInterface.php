<?php

namespace App\Backend\MediaConverter\Facade;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;

interface MediaConverterFacadeInterface
{
    /**
     * @param FileTransfer $fileTransfer
     *
     * @return MediaMetadataTransfer
     */
    public function extractMediaMetadata(FileTransfer $fileTransfer): MediaMetadataTransfer;

    /**
     * @param MediaConfigurationTransfer $mediaConfigurationTransfer
     *
     * @return MediaConvertedResultTransfer
     */
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer): MediaConvertedResultTransfer;

    /**
     * @param MediaMetadataTransfer $videoMetadataTransfer
     *
     * @return MediaResolutionCollectionTransfer
     */
    public function calculateMediaResolutions(MediaMetadataTransfer $videoMetadataTransfer): MediaResolutionCollectionTransfer;

    /**
     * @param MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer
     *
     * @return DashManifestTransfer
     */
    public function generateDashManifest(MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer): DashManifestTransfer;
}