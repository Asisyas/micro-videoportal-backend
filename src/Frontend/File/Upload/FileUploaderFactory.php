<?php

namespace App\Frontend\File\Upload;

use App\Client\File\Client\ClientFileInterface;
use App\Frontend\File\Factory\FileUploadTransferFactoryInterface;

class FileUploaderFactory implements FileUploaderFactoryInterface
{
    /**
     * @param FileUploadTransferFactoryInterface $fileUploadTransferFactory
     * @param ClientFileInterface $fileClient
     */
    public function __construct(
        private readonly FileUploadTransferFactoryInterface $fileUploadTransferFactory,
        private readonly ClientFileInterface $fileClient
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
