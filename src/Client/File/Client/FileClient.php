<?php

namespace App\Client\File\Client;

use App\Client\File\FileClientInterface;
use App\Client\File\Reader\FileClientReaderFactoryInterface;
use App\Client\File\Store\FileClientStoreFactoryInterface;
use App\Client\File\Uploader\FileUploaderFactoryInterface;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkTransfer;
use App\Shared\Generated\DTO\File\FileCreatedTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

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
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileCreatedTransfer
    {
        return $this->fileClientStoreFactory
            ->create()
            ->createFile($fileCreateTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function uploadFile(ChunkTransfer $chunkTransfer): ChunkResponseTransfer
    {
        return $this->fileUploaderFactory
            ->create()
            ->upload($chunkTransfer);
    }
}