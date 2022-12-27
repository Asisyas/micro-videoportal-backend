<?php

namespace App\Client\Search\Expander\SearchResults;

use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;

interface SearchResultsExpanderInterface
{
    /**
     * @param SearchResultCollectionTransfer $resultCollectionTransfer
     *
     * @param array $elasticSource
     *
     * @return void
     */
    public function expand(SearchResultCollectionTransfer $resultCollectionTransfer, array $elasticSource): void;
}
