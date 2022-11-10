<?php

namespace App\Client\Video\Storage;

interface VideoStorageFactoryInterface
{
    /**
     * @return VideoStorageInterface
     */
    public function create(): VideoStorageInterface;
}