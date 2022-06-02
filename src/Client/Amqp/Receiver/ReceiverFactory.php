<?php

namespace App\Client\Amqp\Receiver;

use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\TaskStatus\Core\Business\Client\Driver\ClientTaskStatusDriverFactoryInterface;

class ReceiverFactory implements ReceiverFactoryInterface
{
    public function __construct(
        private readonly ClientTaskStatusDriverFactoryInterface $clientTaskStatusDriverFactory,
        private SerializerFacadeInterface $serializerFacade
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function create(): ReceiverInterface
    {
        return new Receiver(
            $this->clientTaskStatusDriverFactory->create(),
            $this->serializerFacade
        );
    }
}