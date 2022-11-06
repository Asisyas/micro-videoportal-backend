<?php

namespace App\Backend\VideoConverter\Facade;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\ResolutionCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

interface VideoConverterFacadeInterface
{
    /**
     * @param FileTransfer $fileTransfer
     *
     * @return VideoMetadataTransfer
     */
    public function extractVideoMetadata(FileTransfer $fileTransfer): VideoMetadataTransfer;

    /**
     * @param FileTransfer $fileTransfer
     * @param ResolutionTransfer $resolutionTransfer
     *
     * @return VideoConvertResultTransfer
     */
    public function convertVideo(FileTransfer $fileTransfer, ResolutionTransfer $resolutionTransfer): VideoConvertResultTransfer;

    /**
     * @param VideoMetadataTransfer $videoMetadataTransfer
     *
     * @return ResolutionCollectionTransfer
     */
    public function calculateVideoResolutions(VideoMetadataTransfer $videoMetadataTransfer): ResolutionCollectionTransfer;
}