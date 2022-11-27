<?php

namespace App\Frontend\VideoWatch\Facade;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Frontend\VideoWatch\Exapnder\VideoWatchExpanderFactoryInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTRansfer;
use App\Shared\Video\Configuration;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class VideoWatchFacade implements VideoWatchFacadeInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param VideoWatchExpanderFactoryInterface $videoWatchExpanderFactory
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly VideoWatchExpanderFactoryInterface $videoWatchExpanderFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function handleVideoWatchRequest(Request $request): VideoWatchTransfer
    {
        $videoId = $request->get('id');
        try {
            /** @var VideoWatchTransfer $videoWatchTransfer */
            $videoWatchTransfer = $this->clientReaderFacade->lookup(
                (new RequestTransfer())
                    ->setIndex(Configuration::STORAGE_INDEX_KEY)
                    ->setUuid($videoId)
            )->getData();
        } catch (NotFoundException $exception) {
            throw new HttpNotFoundException();
        }

        $this->videoWatchExpanderFactory->create()->expand($videoWatchTransfer);

        return $videoWatchTransfer;
    }
}