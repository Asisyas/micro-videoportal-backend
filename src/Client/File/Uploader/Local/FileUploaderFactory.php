<?php

namespace App\Client\File\Uploader\Local;

use App\Client\File\Reader\FileClientReaderFactoryInterface;
use App\Client\File\Uploader\FileUploaderFactoryInterface;
use App\Client\File\Uploader\FileUploaderInterface;

class FileUploaderFactory implements FileUploaderFactoryInterface
{
    /**
     * TODO: Tmp Dir configurable
     *
     * @param FileClientReaderFactoryInterface $fileClientReaderFactory
     * @param string $tmpDir
     */
    public function __construct(
        private readonly FileClientReaderFactoryInterface $fileClientReaderFactory,
        private readonly string $tmpDir = '/tmp/videoportal'
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function create(): FileUploaderInterface
    {
        return new FileUploader(
            $this->fileClientReaderFactory->create(),
            $this->tmpDir
        );
    }
}