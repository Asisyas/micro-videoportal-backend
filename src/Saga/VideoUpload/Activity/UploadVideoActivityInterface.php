<?php

namespace App\Saga\VideoUpload\Activity;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\SourceFileMetadataTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Generated\DTO\VideoConverterConfigTransfer;
use Temporal\Activity\ActivityInterface;

#[ActivityInterface]
interface UploadVideoActivityInterface extends \Micro\Plugin\Temporal\Activity\ActivityInterface
{
    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     */
    public function lookupSourceFile(FileGetTransfer $fileGetTransfer): FileTransfer;

    /**
     * @param FileTransfer $fileTransfer
     *
     * @return void
     */
    public function removeInvalidSourceFile(FileTransfer $fileTransfer): void;

    /**
     * @param FileTransfer $fileGetTransfer
     *
     * @return SourceFileMetadataTransfer
     */
    public function extractVideoMetadata(FileTransfer $fileGetTransfer): SourceFileMetadataTransfer;

    /**
     * @param VideoConverterConfigTransfer $videoConverterConfigTransfer
     *
     * @return array
     */
    public function convertVideo(VideoConverterConfigTransfer $videoConverterConfigTransfer): array;
}