<?php

namespace App\Client\ClientReader\Facade;

use App\Client\ClientReader\Business\Client\ClientFactoryInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\ClientReader\ResponseTransfer;

class ClientReaderFacade implements ClientReaderFacadeInterface
{
    /**
     * @param ClientFactoryInterface $clientFactory
     */
    public function __construct(private readonly ClientFactoryInterface $clientFactory)
    {
    }

    /**
     * @param RequestTransfer $requestTransfer
     *
     * @return ResponseTransfer
     */
    public function lookup(RequestTransfer $requestTransfer): ResponseTransfer
    {
        return $this->clientFactory
            ->create()
            ->lookup($requestTransfer);
    }
}