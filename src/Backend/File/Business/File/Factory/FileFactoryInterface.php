<?php

namespace App\Backend\File\Business\File\Factory;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

interface FileFactoryInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function create(FileUploadTransfer $fileUploadTransfer): FileTransfer;
}
