<?php

namespace App\Backend\SearchStorage\Business\Storage;

use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use Elastic\Elasticsearch\Client;
use Micro\Library\DTO\SerializerFacadeInterface;

class ElasticStorage implements StorageInterface
{
    /**
     * @param Client $client
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly Client $client,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function index(IndexAddTransfer $indexAddTransfer): void
    {
        $parameters = [
            'index' => $indexAddTransfer->getIndex(),
            'body'  => $this->serializerFacade->toArray($indexAddTransfer->getBody()),
            'id'    => $indexAddTransfer->getId(),
        ];

        $this->client->index($parameters);
    }
}