<?php

namespace App\Backend\Category\Business\Storage;

interface StorageManagerFactoryInterface
{
    /**
     * @return StorageManagerInterface
     */
    public function create(): StorageManagerInterface;
}