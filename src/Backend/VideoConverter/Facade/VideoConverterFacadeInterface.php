<?php

namespace App\Backend\VideoConverter\Facade;

use App\Shared\Generated\DTO\File\FileTransfer;
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
     * @param VideoConvertTransfer $videoConvertTransfer
     *
     * @return VideoConvertResultTransfer
     */
    public function convertVideo(VideoConvertTransfer $videoConvertTransfer): VideoConvertResultTransfer;
}