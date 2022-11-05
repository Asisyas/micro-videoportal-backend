<?php

namespace App\Frontend\File\Factory;

use App\Frontend\File\Expander\FileUpload\FileUploadTransferExpanderFactoryInterface;
use App\Frontend\File\Validator\FileUpload\FileUploadRequestValidatorFactory;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Symfony\Component\HttpFoundation\Request;

class FileUploadTransferFactory implements FileUploadTransferFactoryInterface
{
    /**
     * @param FileUploadTransferExpanderFactoryInterface $fileUploadTransferExpanderFactory
     * @param FileUploadRequestValidatorFactory $fileUploadRequestValidatorFactory
     */
    public function __construct(
        private readonly FileUploadTransferExpanderFactoryInterface $fileUploadTransferExpanderFactory,
        private readonly FileUploadRequestValidatorFactory $fileUploadRequestValidatorFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFromRequest(Request $request): FileUploadTransfer
    {
        $this->fileUploadRequestValidatorFactory
            ->create()
            ->validate($request->headers->all());

        $fileUploadTransfer = new FileUploadTransfer();
        $this->fileUploadTransferExpanderFactory
            ->create()
            ->expand($fileUploadTransfer, $request);

        return $fileUploadTransfer;
    }
}