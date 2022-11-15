<?php

namespace App\Client\Video\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;

class VideoReaderFactory implements VideoReaderFactoryInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade
    )
    {
    }

    /**
     * @return VideoReaderInterface
     */
    public function create(): VideoReaderInterface
    {
        return new VideoReader($this->clientReaderFacade);
    }
}