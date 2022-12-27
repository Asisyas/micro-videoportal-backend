<?php

namespace App\Client\Search\Expander\SearchResults;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Search\Expander\SearchResults\Expander\Video\TemporaryExpander;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;

class SearchResultsExpanderFactory implements SearchResultsExpanderFactoryInterface
{
    private readonly iterable $searchResultsExpanderCollection;

    /**
     * @param SearchResultsExpanderInterface ...$searchResultsExpander
     */
    public function __construct(
        SearchResultsExpanderInterface ...$searchResultsExpander
    ) {
        $this->searchResultsExpanderCollection = $searchResultsExpander;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): SearchResultsExpanderInterface
    {
        return new SearchResultsExpander(
            $this->searchResultsExpanderCollection
        );
    }
}
