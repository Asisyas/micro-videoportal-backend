<?php

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator\Impl;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
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
    public function propagate(VideoTransfer $videoTransfer): void
    {
        $indexAddTransfer = new IndexAddTransfer();
        $indexAddTransfer
            ->setIndex(Configuration::STORAGE_INDEX_KEY)
            ->setId($videoTransfer->getId())
            ->setBody($videoTransfer)
        ;

        $this->searchStorageFacade->index($indexAddTransfer);
    }
}
