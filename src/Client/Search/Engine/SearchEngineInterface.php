<?php

namespace App\Client\Search\Engine;

use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Search\SearchTransfer;

interface SearchEngineInterface
{
    /**
     * @param SearchTransfer $searchTransfer
     *
     * @return SearchResultCollectionTransfer
     */
    public function search(SearchTransfer $searchTransfer): SearchResultCollectionTransfer;
}