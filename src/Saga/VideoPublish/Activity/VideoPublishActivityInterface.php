<?php

namespace App\Saga\VideoPublish\Activity;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\StreamTransfer;
use App\Shared\Generated\DTO\Video\ResolutionSimpleTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Temporal\Activity\ActivityInterface;
use Micro\Plugin\Temporal\Activity\ActivityInterface as MicroActivityInterface;

#[ActivityInterface]
interface VideoPublishActivityInterface extends MicroActivityInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;

    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     */
    public function lookupSourceFile(FileGetTransfer $fileGetTransfer): FileTransfer;

    /**
     * @param FileRemoveTransfer $fileRemoveTransfer
     *
     * @return bool
     */
    public function removeSourceFile(FileRemoveTransfer $fileRemoveTransfer): bool;

    /**
     * @param FileTransfer $fileTransfer
     *
     * @return MediaMetadataTransfer
     */
    public function extractMediaMetadata(FileTransfer $fileTransfer): MediaMetadataTransfer;

    /**
     * @param MediaMetadataTransfer $videoMetadataTransfer
     *
     * @return MediaResolutionCollectionTransfer
     */
    public function calculateMediaResolutions(MediaMetadataTransfer $videoMetadataTransfer): MediaResolutionCollectionTransfer;

    /**
     * @param MediaConfigurationTransfer $mediaConfigurationTransfer
     *
     * @return MediaConvertedResultTransfer
     */
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer): MediaConvertedResultTransfer;

    /**
     * @param MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer
     *
     * @return DashManifestTransfer
     */
    public function generateDashManifest(MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer): DashManifestTransfer;
}