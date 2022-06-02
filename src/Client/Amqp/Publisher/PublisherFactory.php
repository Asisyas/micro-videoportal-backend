<?php

namespace App\Client\Amqp\Publisher;

use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class PublisherFactory implements PublisherFactoryInterface
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
    ) {}

    /**
     * {@inheritDoc}
     */
    public function create(): PublisherInterface
    {
        return new Publisher(
            $this->uuidFacade,
            $this->amqpFacade,
            $this->serializerFacade
        );
    }
}