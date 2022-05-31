<?php

namespace App\Client\Amqp\Client;

use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;

interface AmqpClientInterface
{
    /**
     * @param RequestTransfer $requestTransfer
     *
     * @return ResponseTransfer
     */
    public function publish(RequestTransfer $requestTransfer): ResponseTransfer;
}