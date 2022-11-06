<?php

namespace App\Backend\VideoConverter\Business\Metadata;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

interface VideoMetadataExtractorInterface
{
    /**
     * @param FileTransfer $fileTransfer
     *
     * @return VideoMetadataTransfer
     */
    public function extract(FileTransfer $fileTransfer): VideoMetadataTransfer;
}