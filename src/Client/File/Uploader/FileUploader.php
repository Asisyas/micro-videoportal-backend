<?php

namespace App\Client\File\Uploader;

use App\Client\File\Store\FileClientStoreInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;

readonly class FileUploader implements FileUploaderInterface
{
    /**
     * @param FileClientStoreInterface $fileClientStore
     * @param FilesystemOperator $filesystemOperator
     */
    public function __construct(
        private FileClientStoreInterface $fileClientStore,
        private FilesystemOperator       $filesystemOperator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function uploadFromStream(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        $fileTransfer = $this->fileClientStore->createFile($fileUploadTransfer);
        $stream = fopen($fileUploadTransfer->getSource(), 'r');
        if (!$stream) {
            $this->compensate($fileTransfer);

            throw new \InvalidArgumentException(sprintf('Can not open file %s', $fileUploadTransfer->getSource()));
        }
        try {
            $this->filesystemOperator->writeStream($fileTransfer->getId(), $stream);
        } catch (FilesystemException $exception) {
            $this->compensate($fileTransfer);

            throw $exception;
        } finally {
            fclose($stream);
        }

        return $fileTransfer;
    }

    /**
     * @param FileTransfer $fileTransfer
     *
     * @return void
     */
    protected function compensate(FileTransfer $fileTransfer): void
    {
        $this->fileClientStore->deleteFile((new FileRemoveTransfer())->setId($fileTransfer->getId()));
    }
}
