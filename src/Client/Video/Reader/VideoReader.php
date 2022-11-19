<?php

namespace App\Client\Video\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTRansfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Configuration;

class VideoReader implements VideoReaderInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
    )
    {
    }

    /**
     * @param VideoWatchTRansfer $videoGetTransfer
     *
     * @return VideoTransfer
     */
    public function lookup(VideoWatchTRansfer $videoGetTransfer): VideoTransfer
    {
        $request = new RequestTransfer();
        $request->setIndex(Configuration::STORAGE_INDEX_KEY);
        $request->setUuid($videoGetTransfer->getVideoId());

        $response = $this->clientReaderFacade->lookup($request);

        return $response->getData();
    }
}