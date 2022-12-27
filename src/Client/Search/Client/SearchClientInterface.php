<?php

namespace App\Client\Search\Client;

use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Search\SearchTransfer;

interface SearchClientInterface
{
    /**
     * @param SearchTransfer $searchTransfer
     *
     * @return SearchResultCollectionTransfer
     */
    public function search(SearchTransfer $searchTransfer): SearchResultCollectionTransfer;
}
