<?php

namespace App\Client\File\Uploader;

use App\Client\File\Store\FileClientStoreInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use League\Flysystem\FilesystemOperator;

class FileUploader implements FileUploaderInterface
{
    /**
     * @param FileClientStoreInterface $fileClientStore
     * @param FilesystemOperator $filesystemOperator
     */
    public function __construct(
        private readonly FileClientStoreInterface $fileClientStore,
        private readonly FilesystemOperator       $filesystemOperator
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function uploadFromStream(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        $fileTransfer = $this->fileClientStore->createFile($fileUploadTransfer);
        $stream = fopen($fileUploadTransfer->getSource(), 'r');
        $this->filesystemOperator->writeStream($fileTransfer->getId(), $stream);

        fclose($stream);

        return $fileTransfer;
    }
}