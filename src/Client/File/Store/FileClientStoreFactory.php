<?php

namespace App\Client\File\Store;

use App\Client\Amqp\Client\AmqpClientInterface;

class FileClientStoreFactory implements FileClientStoreFactoryInterface
{
    /**
     * @param AmqpClientInterface $amqpClient
     */
    public function __construct(
        private readonly AmqpClientInterface $amqpClient
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): FileClientStoreInterface
    {
        return new FileClientStore($this->amqpClient);
    }
}