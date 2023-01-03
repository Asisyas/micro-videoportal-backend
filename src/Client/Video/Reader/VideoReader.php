<?php

namespace App\Client\Video\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Facade\VideoTransferExpanderFacadeInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Configuration;

class VideoReader implements VideoReaderInterface
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
     * @inheritDoc
     */
    public function lookup(VideoGetTransfer $videoGetTransfer): VideoTransfer
    {
        $request = new RequestTransfer();
        $request->setIndex(Configuration::STORAGE_INDEX_KEY);
        $request->setUuid($videoGetTransfer->getVideoId());

        $response = $this->clientReaderFacade->lookup($request);
        /** @var VideoTransfer $videoTransfer */
        $videoTransfer = $response->getData();

        $this->videoTransferExpanderFacade->expand($videoTransfer);

        return $videoTransfer;
    }
}
