<?php

namespace App\Saga\VideoPublish\Activity;

use App\Backend\VideoConverter\Facade\VideoConverterFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\ResolutionCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

class VideoPublishActivity implements VideoPublishActivityInterface
{
    /**
     * @param FileClientInterface $fileClient
     * @param VideoConverterFacadeInterface $videoConverterFacade
     */
    public function __construct(
        private readonly FileClientInterface $fileClient,
        private readonly VideoConverterFacadeInterface $videoConverterFacade
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
    public function extractVideoMetadata(FileTransfer $fileTransfer): VideoMetadataTransfer
    {
        return $this->videoConverterFacade->extractVideoMetadata($fileTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function calculateVideoResolutions(VideoMetadataTransfer $videoMetadataTransfer): ResolutionCollectionTransfer
    {
        return $this->videoConverterFacade->calculateVideoResolutions($videoMetadataTransfer);
    }

    /**
     * @param FileTransfer $fileTransfer
     * @param ResolutionTransfer $resolutionTransfer
     *
     * @return void
     */
    public function convertVideo(FileTransfer $fileTransfer, ResolutionTransfer $resolutionTransfer)
    {
        $this->videoConverterFacade->convertVideo($fileTransfer, $resolutionTransfer);
    }
}