<?php

namespace App\Client\ClientReader\Facade;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\ClientReader\ResponseTransfer;

interface ClientReaderFacadeInterface
{
    /**
     * @param RequestTransfer $requestTransfer
     *
     * @return ResponseTransfer
     *
     * @throws NotFoundException
     */
    public function lookup(RequestTransfer $requestTransfer): ResponseTransfer;
}