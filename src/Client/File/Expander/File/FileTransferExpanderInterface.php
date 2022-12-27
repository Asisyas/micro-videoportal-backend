<?php

namespace App\Client\File\Expander\File;

use App\Shared\Generated\DTO\File\FileTransfer;

interface FileTransferExpanderInterface
{
    /**
     * @param FileTransfer $fileTransfer
     *
     * @return void
     */
    public function expand(FileTransfer $fileTransfer): void;
}
