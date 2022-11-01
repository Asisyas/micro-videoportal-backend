<?php

namespace App\Backend\VideoConverter\Facade;

use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\SourceFileMetadataTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoResolutionConvertRunTransfer;

interface VideoConverterFacadeInterface
{
    /**
     * @param VideoResolutionConvertRunTransfer $resolutionConvertRunTransfer
     *
     * @return ResponseTransfer
     */
    public function runVideoResolutionConverting(VideoResolutionConvertRunTransfer $resolutionConvertRunTransfer): ResponseTransfer;

    public function runVideoConverting();

    public function getVideoMetadata(FileTransfer $fileTransfer): SourceFileMetadataTransfer;
}