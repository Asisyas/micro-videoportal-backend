<?php

namespace App\Backend\File\Business\File\Storage;

interface FileStorageFactoryInterface
{
    /**
     * @return FileStorageInterface
     */
    public function create(): FileStorageInterface;
}