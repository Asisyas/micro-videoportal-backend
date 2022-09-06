<?php

namespace App\Client\File\Store;

interface FileClientStoreFactoryInterface
{
    /**
     * @return FileClientStoreInterface
     */
    public function create(): FileClientStoreInterface;
}