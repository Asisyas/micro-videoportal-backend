<?php

namespace App\Frontend\File\Expander\FileUpload;

use App\Frontend\File\Expander\FileUpload\Impl\HeadersProvideExpander;

class FileUploadTransferExpanderFactory implements FileUploadTransferExpanderFactoryInterface
{
    /**
     * @return FileUploadTransferExpanderInterface
     */
    public function create(): FileUploadTransferExpanderInterface
    {
        return new FileUploadTransferExpander(
            new HeadersProvideExpander()
        );
    }
}
