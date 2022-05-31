<?php

namespace App\Client\Amqp\Publisher;

use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;

interface PublisherInterface
{
    /**
     * @param RequestTransfer $requestTransfer
     * @return ResponseTransfer
     */
    public function publish(RequestTransfer $requestTransfer): ResponseTransfer;
}