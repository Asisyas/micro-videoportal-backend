<?php

namespace App\Backend\File\Business\File\Factory;

use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

interface FileFactoryInterface
{
    /**
     * @param FileCreateTransfer $createTransfer
     *
     * @return FileTransfer
     */
    public function create(FileCreateTransfer $createTransfer): FileTransfer;
}