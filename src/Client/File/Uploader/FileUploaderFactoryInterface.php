<?php

namespace App\Client\File\Uploader;

interface FileUploaderFactoryInterface
{
    /**
     * @return FileUploaderInterface
     */
    public function create(): FileUploaderInterface;
}