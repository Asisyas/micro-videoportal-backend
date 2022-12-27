<?php

namespace App\Client\File\Uploader;

use App\Client\File\Store\FileClientStoreFactoryInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class FileUploaderFactory implements FileUploaderFactoryInterface
{
    public function __construct(
        private readonly FileClientStoreFactoryInterface $fileClientStoreFactory,
        private readonly FilesystemFacadeInterface $filesystemFacade
    ) {
    }

    public function create(): FileUploaderInterface
    {
        return new FileUploader(
            $this->fileClientStoreFactory->create(),
            $this->filesystemFacade->createFsOperator()
        );
    }
}
