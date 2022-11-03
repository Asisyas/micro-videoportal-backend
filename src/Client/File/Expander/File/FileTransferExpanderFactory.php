<?php

namespace App\Client\File\Expander\File;

use App\Client\File\Expander\File\Impl\FilePathInternalExpander;

class FileTransferExpanderFactory implements FileTransferExpanderFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): FileTransferExpanderInterface
    {
        return new FileTransferExpander(
            new FilePathInternalExpander()
        );
    }
}