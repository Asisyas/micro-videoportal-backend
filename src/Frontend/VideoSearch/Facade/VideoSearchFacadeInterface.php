<?php

namespace App\Frontend\VideoSearch\Facade;

use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use Symfony\Component\HttpFoundation\Request;

interface VideoSearchFacadeInterface
{
    /**
     * @param Request $request
     *
     * @return SearchResultCollectionTransfer
     */
    public function searchRequest(Request $request): SearchResultCollectionTransfer;
}
