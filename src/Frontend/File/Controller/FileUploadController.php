<?php

namespace App\Frontend\File\Controller;

use App\Frontend\File\Facade\FileFacadeInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Symfony\Component\HttpFoundation\Request;

class FileUploadController
{
    /**
     * @param FileFacadeInterface $fileFacade
     */
    public function __construct(
        private readonly FileFacadeInterface $fileFacade
    ) {
    }

    /**
     * @param Request $request
     *
     * @return FileTransfer
     *
     * @throws HttpBadRequestException
     */
    public function uploadFile(Request $request): FileTransfer
    {
        return $this->fileFacade->handleFileUploadRequest($request);
    }
}
