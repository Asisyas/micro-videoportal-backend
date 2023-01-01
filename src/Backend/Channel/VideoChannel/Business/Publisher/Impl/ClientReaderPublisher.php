<?php

namespace App\Backend\Channel\VideoChannel\Business\Publisher\Impl;

use App\Backend\Channel\VideoChannel\Business\Publisher\TransferPublisherInterface;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Constants;

class ClientReaderPublisher implements TransferPublisherInterface
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
    public function publish(VideoChannelTransfer $videoChannelTransfer): void
    {
        $this->clientStorageFacade->put(
            (new PutTransfer())
                ->setIndex(Constants::STORAGE_IDX)
                ->setUuid($videoChannelTransfer->getId())
                ->setData($videoChannelTransfer)
        );
    }
}
