<?php

namespace App\Client\Video\Reader;

interface VideoReaderFactoryInterface
{
    /**
     * @return VideoReaderInterface
     */
    public function create(): VideoReaderInterface;
}