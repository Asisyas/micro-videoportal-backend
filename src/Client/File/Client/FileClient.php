<?php

namespace App\Client\File\Client;

use App\Client\File\FileClientInterface;
use App\Client\File\Reader\FileClientReaderFactoryInterface;
use App\Client\File\Store\FileClientStoreFactoryInterface;
use App\Client\File\Uploader\FileUploaderFactoryInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

class FileClient implements FileClientInterface
{
    /**
     * @param FileClientStoreFactoryInterface $fileClientStoreFactory
     * @param FileClientReaderFactoryInterface $fileClientReaderFactory
     * @param FileUploaderFactoryInterface $fileUploaderFactory
     */
    public function __construct(
        private readonly FileClientStoreFactoryInterface $fileClientStoreFactory,
        private readonly FileClientReaderFactoryInterface $fileClientReaderFactory,
        private readonly FileUploaderFactoryInterface $fileUploaderFactory
    )
    {
    }

    public function deleteFile(FileRemoveTransfer $fileRemoveTransfer): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookupFile(FileGetTransfer $fileGetTransfer): FileTransfer
    {
        return $this->fileClientReaderFactory
            ->create()
            ->lookup($fileGetTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function uploadFile(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        return $this->fileUploaderFactory
            ->create()
            ->uploadFromStream($fileUploadTransfer);
    }
}