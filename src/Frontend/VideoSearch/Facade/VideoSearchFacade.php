<?php

namespace App\Frontend\VideoSearch\Facade;

use App\Client\Search\Client\SearchClientInterface;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Search\SearchTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoSearchFacade implements VideoSearchFacadeInterface
{
    /**
     * @param SearchClientInterface $searchClient
     */
    public function __construct(
        private readonly SearchClientInterface $searchClient
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function searchRequest(Request $request): SearchResultCollectionTransfer
    {
        $searchTransfer = new SearchTransfer();
        $searchTransfer
            ->setIndex('video')
            ->setQuery([
                '_source' => false,
            ])
        ;

        return $this->searchClient->search($searchTransfer);
    }
}