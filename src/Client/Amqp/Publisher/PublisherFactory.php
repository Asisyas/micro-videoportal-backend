<?php

namespace App\Client\Amqp\Publisher;

use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class PublisherFactory implements PublisherFactoryInterface
{
    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param AmqpFacadeInterface $amqpFacade
     */
    public function __construct(
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly AmqpFacadeInterface $amqpFacade) {}

    /**
     * {@inheritDoc}
     */
    public function create(): PublisherInterface
    {
        return new Publisher(
            $this->uuidFacade,
            $this->amqpFacade
        );
    }
}