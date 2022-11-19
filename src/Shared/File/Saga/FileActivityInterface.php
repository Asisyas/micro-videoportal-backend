<?php

namespace App\Shared\File\Saga;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface]
interface FileActivityInterface extends ActivityInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer;
}