<?php

namespace App\Client\File\Expander\File;

class FileTransferExpanderFactory implements FileTransferExpanderFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): FileTransferExpanderInterface
    {
        return new FileTransferExpander(
        );
    }
}
