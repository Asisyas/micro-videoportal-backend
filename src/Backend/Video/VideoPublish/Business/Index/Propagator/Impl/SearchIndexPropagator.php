<?php

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator\Impl;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use App\Shared\Video\Configuration;

class SearchIndexPropagator implements IndexPropagatorInterface
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
    public function propagate(VideoWatchTransfer $videoWatchTransfer): void
    {
        $indexAddTransfer = new IndexAddTransfer();
        $indexAddTransfer
            ->setIndex(Configuration::STORAGE_INDEX_KEY)
            ->setId($videoWatchTransfer->getId())
            ->setBody($videoWatchTransfer)
        ;

        $this->searchStorageFacade->index($indexAddTransfer);
    }
}
