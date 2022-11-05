<?php

namespace App\Frontend\File\Expander\FileUpload;

use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Symfony\Component\HttpFoundation\Request;

interface FileUploadTransferExpanderInterface
{
    /**
     * @param FileUploadTransfer $fileUploadTransfer
     * @param Request $request
     *
     * @return void
     */
    public function expand(FileUploadTransfer $fileUploadTransfer, Request $request): void;
}