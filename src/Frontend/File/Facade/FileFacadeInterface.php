<?php

namespace App\Frontend\File\Facade;

use App\Shared\Generated\DTO\File\FileTransfer;
use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

interface FileFacadeInterface
{
    /**
     * @param Request $request
     *
     * @return FileTransfer
     *
     * @throws BadRequestException
     */
    public function handleFileUploadRequest(Request $request): FileTransfer;
}