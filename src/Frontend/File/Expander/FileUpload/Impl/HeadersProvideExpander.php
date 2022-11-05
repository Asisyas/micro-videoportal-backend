<?php

namespace App\Frontend\File\Expander\FileUpload\Impl;

use App\Frontend\File\Expander\FileUpload\FileUploadTransferExpanderInterface;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Symfony\Component\HttpFoundation\Request;

class HeadersProvideExpander implements FileUploadTransferExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(FileUploadTransfer $fileUploadTransfer, Request $request): void
    {
        $fileUploadTransfer->setContentType($request->headers->get('content-type'));
        $fileUploadTransfer->setName($request->headers->get('x-file-name'));
        $fileUploadTransfer->setSize((int) $request->headers->get('content-length'));
        $fileUploadTransfer->setSource('php://input');
    }
}