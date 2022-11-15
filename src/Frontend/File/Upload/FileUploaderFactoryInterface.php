<?php

namespace App\Frontend\File\Upload;

interface FileUploaderFactoryInterface
{
    /**
     * @return FileUploaderInterface
     */
    public function create(): FileUploaderInterface;
}