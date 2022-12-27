<?php

namespace App\Client\Search\Client;

use App\Client\Search\Engine\SearchEngineFactoryInterface;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Search\SearchTransfer;

class SearchClient implements SearchClientInterface
{
    /**
     * @param SearchEngineFactoryInterface $searchEngineFactory
     */
    public function __construct(
        private readonly SearchEngineFactoryInterface $searchEngineFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function search(SearchTransfer $searchTransfer): SearchResultCollectionTransfer
    {
        return $this->searchEngineFactory
            ->create()
            ->search($searchTransfer);
    }
}
