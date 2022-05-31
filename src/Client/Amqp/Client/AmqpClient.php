<?php

namespace App\Client\Amqp\Client;

use App\Client\Amqp\Publisher\PublisherFactoryInterface;
use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;

class AmqpClient implements AmqpClientInterface
{
    public function __construct(private readonly PublisherFactoryInterface $publisherFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function publish(RequestTransfer $requestTransfer): ResponseTransfer
    {
        return $this->publisherFactory->create()->publish($requestTransfer);
    }
}