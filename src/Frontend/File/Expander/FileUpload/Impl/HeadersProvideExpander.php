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
        $filenameEncoded = $request->headers->get('x-file-name', 'New video');
        $filename = base64_decode($filenameEncoded);
        if($filename === false) {
            $filename = $filenameEncoded;
        }

        $fileUploadTransfer->setContentType($request->headers->get('content-type'));
        $fileUploadTransfer->setName($filename);
        $fileUploadTransfer->setSize((int) $request->headers->get('content-length'));
        $fileUploadTransfer->setSource('php://input');
    }
}