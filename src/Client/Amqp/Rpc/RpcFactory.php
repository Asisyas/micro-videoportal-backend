<?php

namespace App\Client\Amqp\Rpc;

use App\Client\Amqp\Publisher\PublisherFactoryInterface;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class RpcFactory implements RpcFactoryInterface
{
    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param AmqpFacadeInterface $amqpFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly AmqpFacadeInterface $amqpFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): RpcInterface
    {
        return new Rpc(
            $this->uuidFacade,
            $this->amqpFacade,
            $this->serializerFacade
        );
    }
}