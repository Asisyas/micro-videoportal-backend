<?php

namespace App\Client\Search\Engine;

use App\Client\Search\Expander\SearchResults\SearchResultsExpanderInterface;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Search\SearchTransfer;
use Elastic\Elasticsearch\Client;

class ElasticEngine implements SearchEngineInterface
{

    public function __construct(
        private readonly Client $elasticClient,
        private readonly SearchResultsExpanderInterface $searchResultsExpander
    )
    {
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function search(SearchTransfer $searchTransfer): SearchResultCollectionTransfer
    {
        $searchOpts = [
            'size'    => 10000,
            'index' => $searchTransfer->getIndex(),
            'body'  => $searchTransfer->getQuery()
        ];

        $searchResultsCollection  = new SearchResultCollectionTransfer();

        $sourceResultsData = $this->elasticClient->search($searchOpts);
        $this->searchResultsExpander->expand($searchResultsCollection, $sourceResultsData->asArray());

        return $searchResultsCollection;
    }
}