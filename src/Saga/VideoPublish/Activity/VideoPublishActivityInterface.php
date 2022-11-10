<?php

namespace App\Saga\VideoPublish\Activity;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\ResolutionCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;
use Temporal\Activity\ActivityInterface;
use Micro\Plugin\Temporal\Activity\ActivityInterface as MicroActivityInterface;

#[ActivityInterface]
interface VideoPublishActivityInterface extends MicroActivityInterface
{
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
     * @return VideoMetadataTransfer
     */
    public function extractVideoMetadata(FileTransfer $fileTransfer): VideoMetadataTransfer;

    /**
     * @param VideoMetadataTransfer $videoMetadataTransfer
     *
     * @return ResolutionCollectionTransfer
     */
    public function calculateVideoResolutions(VideoMetadataTransfer $videoMetadataTransfer): ResolutionCollectionTransfer;

    /**
     * @param FileTransfer $fileTransfer
     * @param ResolutionTransfer $resolutionTransfer
     *
     * @return mixed
     */
    public function convertVideo(FileTransfer $fileTransfer, ResolutionTransfer $resolutionTransfer);
}