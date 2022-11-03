<?php

namespace App\Client\File\Expander\File\Impl;

use App\Client\File\Expander\File\FileTransferExpanderInterface;
use App\Shared\Generated\DTO\File\FileTransfer;

class FilePathInternalExpander implements FileTransferExpanderInterface
{
    public function __construct(
        private readonly string $tmpDir = '/tmp/videoportal'
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function expand(FileTransfer $fileTransfer): void
    {
        $fileTransfer->setFilePathInternal($this->getFileDestination($fileTransfer));
    }

    /**
     * @param FileTransfer $fileTransfer
     * @return string
     */
    protected function getFileDestination(FileTransfer $fileTransfer): string
    {
        return rtrim($this->tmpDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileTransfer->getId();
    }
}