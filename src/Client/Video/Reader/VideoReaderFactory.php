<?php

namespace App\Client\Video\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Facade\VideoTransferExpanderFacadeInterface;

class VideoReaderFactory implements VideoReaderFactoryInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly VideoTransferExpanderFacadeInterface $videoTransferExpanderFacade
    ) {
    }

    /**
     * @return VideoReaderInterface
     */
    public function create(): VideoReaderInterface
    {
        return new VideoReader(
            $this->clientReaderFacade,
            $this->videoTransferExpanderFacade
        );
    }
}
