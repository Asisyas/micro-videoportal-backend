<?php

namespace App\Frontend\VideoSearch\Facade;

use App\Client\Search\Client\ClientSearchInterface;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Search\SearchTransfer;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class VideoSearchFacade implements VideoSearchFacadeInterface
{
    /**
     * @param ClientSearchInterface $searchClient
     */
    public function __construct(
        private readonly ClientSearchInterface $searchClient
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function searchRequest(Request $request): SearchResultCollectionTransfer
    {
        $searchTransfer = new SearchTransfer();
        $searchTransfer
            ->setIndex((string) $request->query->get('index', 'video'))
            ->setLimit((int) $request->query->get('limit', 100))
            ->setOffset((int) $request->query->get('offset'))
            ->setQuery([
                'sort'  => [
                    '_score',
                ],
                '_source' => false,
            ])
        ;
        try {
            return $this->searchClient->search($searchTransfer);
        } catch (ClientResponseException $throwable) {
            throw new HttpNotFoundException('');
        }
    }
}
