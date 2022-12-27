<?php

namespace App\Frontend\File\Factory;

use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\File\Expander\FileUpload\FileUploadTransferExpanderFactoryInterface;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Symfony\Component\HttpFoundation\Request;

class FileUploadTransferFactory implements FileUploadTransferFactoryInterface
{
    /**
     * @param FileUploadTransferExpanderFactoryInterface $fileUploadTransferExpanderFactory
     * @param ArrayValidatorFactoryInterface $fileUploadRequestValidatorFactory
     */
    public function __construct(
        private readonly FileUploadTransferExpanderFactoryInterface $fileUploadTransferExpanderFactory,
        private readonly ArrayValidatorFactoryInterface $fileUploadRequestValidatorFactory
    ) {
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
