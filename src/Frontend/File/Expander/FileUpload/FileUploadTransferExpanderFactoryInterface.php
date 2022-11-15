<?php

namespace App\Frontend\File\Expander\FileUpload;

interface FileUploadTransferExpanderFactoryInterface
{
    /**
     * @return FileUploadTransferExpanderInterface
     */
    public function create(): FileUploadTransferExpanderInterface;
}