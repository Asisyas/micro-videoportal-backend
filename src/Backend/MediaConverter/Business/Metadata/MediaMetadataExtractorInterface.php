<?php

namespace App\Backend\MediaConverter\Business\Metadata;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;

interface MediaMetadataExtractorInterface
{
    /**
     * @param FileTransfer $fileTransfer
     *
     * @return MediaMetadataTransfer
     */
    public function extract(FileTransfer $fileTransfer): MediaMetadataTransfer;
}
