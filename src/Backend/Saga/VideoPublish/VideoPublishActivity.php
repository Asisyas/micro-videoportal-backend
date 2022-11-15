<?php

namespace App\Backend\Saga\VideoPublish;

use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Client\Video\Client\VideoClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;

class VideoPublishActivity implements VideoPublishActivityInterface
{
    /**
     * @param FileClientInterface $fileClient
     * @param MediaConverterFacadeInterface $videoConverterFacade
     * @param VideoClientInterface $videoClient
     */
    public function __construct(
        private readonly FileClientInterface           $fileClient,
        private readonly MediaConverterFacadeInterface $videoConverterFacade,
        private readonly VideoClientInterface          $videoClient
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function removeSourceFile(FileRemoveTransfer $fileRemoveTransfer): bool
    {
        $this->fileClient->deleteFile($fileRemoveTransfer);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function lookupSourceFile(FileGetTransfer $fileGetTransfer): FileTransfer
    {
        return $this->fileClient->lookupFile($fileGetTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function extractMediaMetadata(FileTransfer $fileTransfer): MediaMetadataTransfer
    {
        return $this->videoConverterFacade->extractMediaMetadata($fileTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function calculateMediaResolutions(MediaMetadataTransfer $videoMetadataTransfer): MediaResolutionCollectionTransfer
    {
        return $this->videoConverterFacade->calculateMediaResolutions($videoMetadataTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer): MediaConvertedResultTransfer
    {
        return $this->videoConverterFacade->convert($mediaConfigurationTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        return $this->videoClient->createVideo($videoCreateTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function generateDashManifest(MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer): DashManifestTransfer
    {
        return $this->videoConverterFacade->generateDashManifest($convertedResultCollectionTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer
    {
        return $this->videoClient->updateVideo($videoTransfer);
    }
}