<?php

namespace App\Client\ClientReader\Business\Client;

use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\ClientReader\ResponseTransfer;

interface ClientInterface
{
    /**
     * @param RequestTransfer $requestTransfer
     *
     * @return ResponseTransfer
     */
    public function lookup(RequestTransfer $requestTransfer): ResponseTransfer;
}