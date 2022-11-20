<?php

namespace App\Client\Search\Expander\SearchResults\Video;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Search\Expander\SearchResults\SearchResultsExpanderInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Search\ResultTransfer;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;

class TemporaryExpander implements SearchResultsExpanderInterface
{
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(SearchResultCollectionTransfer $resultCollectionTransfer, array $elasticSource): void
    {
        $resultCollectionTransfer->setTotal((int)$elasticSource['hits']['total']['value'] ?? 0);
        $hits = $elasticSource['hits']['hits'] ?? [];
        foreach ($hits as $hit) {
            $id = $hit['_id'];
            $index = $hit['_index'];

            $result = $this->clientReaderFacade->lookup(
                (new RequestTransfer())
                    ->setUuid($id)
                    ->setIndex($index)
            );

            $resultCollectionTransfer->setResults(
                [(new ResultTransfer())
                    ->setSource($result->getData())
                    ->setType($index)]
            );
        }
    }
}