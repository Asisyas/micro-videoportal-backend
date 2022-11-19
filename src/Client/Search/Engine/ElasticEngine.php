<?php

namespace App\Client\Search\Engine;

use App\Shared\Generated\DTO\Search\SearchTransfer;
use Elastic\Elasticsearch\Client;

class ElasticEngine implements SearchEngineInterface
{

    public function __construct(
        private readonly Client $elasticClient,
    )
    {
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function search(SearchTransfer $searchTransfer): mixed
    {
        $searchOpts = [
            'index' => $searchTransfer->getIndex(),
            'body'  => $searchTransfer->getQuery()
        ];

        return $this->elasticClient->search($searchOpts);
    }
}