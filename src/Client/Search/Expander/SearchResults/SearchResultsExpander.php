<?php

namespace App\Client\Search\Expander\SearchResults;

use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;

class SearchResultsExpander implements SearchResultsExpanderInterface
{
    /**
     * @param iterable<SearchResultsExpanderInterface> $expanders
     */
    public function __construct(private readonly iterable $expanders)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(SearchResultCollectionTransfer $resultCollectionTransfer, array $elasticSource): void
    {
        foreach ($this->expanders as $expander) {
            $expander->expand($resultCollectionTransfer, $elasticSource);
        }
    }
}