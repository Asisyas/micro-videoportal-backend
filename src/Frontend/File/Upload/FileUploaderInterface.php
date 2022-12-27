<?php

namespace App\Frontend\File\Upload;

use App\Shared\Generated\DTO\File\FileTransfer;
use Symfony\Component\HttpFoundation\Request;

interface FileUploaderInterface
{
    /**
     * @param Request $request
     *
     * @return FileTransfer
     */
    public function upload(Request $request): FileTransfer;
}
