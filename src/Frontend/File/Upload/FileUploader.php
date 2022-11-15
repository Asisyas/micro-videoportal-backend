<?php

namespace App\Frontend\File\Upload;

use App\Client\File\FileClientInterface;
use App\Frontend\File\Factory\FileUploadTransferFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use Symfony\Component\HttpFoundation\Request;

class FileUploader implements FileUploaderInterface
{
    /**
     * @param FileUploadTransferFactoryInterface $fileUploadTransferFactory
     * @param FileClientInterface $fileClient
     */
    public function __construct(
        private readonly FileUploadTransferFactoryInterface $fileUploadTransferFactory,
        private readonly FileClientInterface $fileClient
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function upload(Request $request): FileTransfer
    {
        $fileUploadTransfer = $this->fileUploadTransferFactory->createFromRequest($request);

        return $this->fileClient->uploadFile($fileUploadTransfer);
    }
}