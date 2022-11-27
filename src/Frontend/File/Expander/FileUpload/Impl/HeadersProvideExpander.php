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
        $filename = base64_decode($filenameEncoded, true);

        if($filename === false || base64_encode($filename) !== $filenameEncoded) {
            $filename = $filenameEncoded;
        }

        $fileUploadTransfer->setContentType($request->headers->get('content-type'));
        $fileUploadTransfer->setName(urldecode($filename));
        $fileUploadTransfer->setSize((int) $request->headers->get('content-length'));
        $fileUploadTransfer->setSource('php://input');
    }
}