<?php

namespace App\Frontend\File\Factory;

use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Symfony\Component\HttpFoundation\Request;

interface FileUploadTransferFactoryInterface
{
    /**
     * @param Request $request
     *
     * @return FileUploadTransfer
     *
     * @throws HttpBadRequestException
     */
    public function createFromRequest(Request $request): FileUploadTransfer;
}
