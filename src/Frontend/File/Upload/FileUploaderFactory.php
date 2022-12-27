<?php

namespace App\Frontend\File\Upload;

use App\Client\ClientReader\Business\Client\ClientInterface;
use App\Client\File\FileClientInterface;
use App\Frontend\File\Factory\FileUploadTransferFactoryInterface;

class FileUploaderFactory implements FileUploaderFactoryInterface
{
    /**
     * @param FileUploadTransferFactoryInterface $fileUploadTransferFactory
     * @param FileClientInterface $fileClient
     */
    public function __construct(
        private readonly FileUploadTransferFactoryInterface $fileUploadTransferFactory,
        private readonly FileClientInterface $fileClient
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): FileUploaderInterface
    {
        return new FileUploader(
            $this->fileUploadTransferFactory,
            $this->fileClient
        );
    }
}
