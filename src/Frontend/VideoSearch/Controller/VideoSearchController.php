<?php

namespace App\Frontend\VideoSearch\Controller;

use App\Frontend\VideoSearch\Facade\VideoSearchFacadeInterface;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VideoSearchController
{
    /**
     * @param VideoSearchFacadeInterface $videoSearchFacade
     */
    public function __construct(
        private readonly VideoSearchFacadeInterface $videoSearchFacade
    )
    {
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function search(Request $request): SearchResultCollectionTransfer
    {
        return $this->videoSearchFacade->searchRequest($request);
    }
}