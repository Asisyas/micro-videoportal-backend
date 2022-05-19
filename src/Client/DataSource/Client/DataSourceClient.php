<?php

namespace App\Client\DataSource\Client;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

class DataSourceClient implements DataSourceClientInterface
{
    public function __construct(private readonly ClientReaderFacadeInterface $clientReaderFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(string $uuid): DataSourceTransfer
    {
        $requestTransfer = new RequestTransfer();
        $requestTransfer->setUuid($uuid);
        $requestTransfer->setIndex('data_source');

        $response = $this->clientReaderFacade->lookup($requestTransfer);

        return new DataSourceTransfer($response->getData());
    }
}