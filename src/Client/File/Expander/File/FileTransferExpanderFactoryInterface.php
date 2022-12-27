<?php

namespace App\Client\File\Expander\File;

interface FileTransferExpanderFactoryInterface
{
    /**
     * @return FileTransferExpanderInterface
     */
    public function create(): FileTransferExpanderInterface;
}
