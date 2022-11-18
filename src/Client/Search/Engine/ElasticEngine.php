<?php

namespace App\Client\Search\Engine;

use App\Shared\Generated\DTO\Search\SearchTransfer;
use Elastic\Elasticsearch\Client;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

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

        $response = $this->elasticClient->search($searchOpts);

        return $response;
    }
}