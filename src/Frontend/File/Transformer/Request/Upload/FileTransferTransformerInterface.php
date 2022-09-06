<?php

namespace App\Frontend\File\Transformer\Request\Upload;

use App\Shared\Generated\DTO\File\FindChannelTransfer;
use Symfony\Component\HttpFoundation\Request;

interface FileTransferTransformerInterface
{
    /**
     * @param Request $request
     *
     * @return FindChannelTransfer
     */
    public function transform(Request $request): FindChannelTransfer;
}