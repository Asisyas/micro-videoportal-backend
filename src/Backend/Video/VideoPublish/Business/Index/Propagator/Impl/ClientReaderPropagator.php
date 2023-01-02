<?php

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator\Impl;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorInterface;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use App\Shared\Video\Configuration;

class ClientReaderPropagator implements IndexPropagatorInterface
{
    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(
        private readonly ClientStorageFacadeInterface $clientStorageFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function propagate(VideoWatchTransfer $videoWatchTransfer): void
    {
        $put = new PutTransfer();
        $put
            ->setIndex(Configuration::STORAGE_INDEX_KEY)
            ->setUuid($videoWatchTransfer->getId())
            ->setData($videoWatchTransfer);

        $this->clientStorageFacade->put($put);
    }
}
