<?php

namespace App\Frontend\File\Facade;

use App\Frontend\File\Upload\FileUploaderFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use Symfony\Component\HttpFoundation\Request;

class FileFacade implements FileFacadeInterface
{
    /**
     * @param FileUploaderFactoryInterface $fileUploaderFactory
     */
    public function __construct(
        private readonly FileUploaderFactoryInterface $fileUploaderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function handleFileUploadRequest(Request $request): FileTransfer
    {
        return $this->fileUploaderFactory
            ->create()
            ->upload($request);
    }
}
