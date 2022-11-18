<?php

namespace App\Backend\SearchStorage\Business\Storage;

interface StorageFactoryInterface
{
    /**
     * @return StorageInterface
     */
    public function create(): StorageInterface;
}