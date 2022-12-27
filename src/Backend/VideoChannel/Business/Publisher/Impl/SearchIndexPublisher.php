<?php

namespace App\Backend\VideoChannel\Business\Publisher\Impl;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\VideoChannel\Business\Publisher\TransferPublisherInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Constants;

class SearchIndexPublisher implements TransferPublisherInterface
{
    /**
     * @param SearchStorageFacadeInterface $searchStorageFacade
     */
    public function __construct(
        private readonly SearchStorageFacadeInterface $searchStorageFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function publish(VideoChannelTransfer $videoChannelTransfer): void
    {
        $this->searchStorageFacade->index(
            (new IndexAddTransfer())
                ->setIndex(Constants::STORAGE_IDX)
                ->setId($videoChannelTransfer->getId())
                ->setBody($videoChannelTransfer)
        );
    }
}
