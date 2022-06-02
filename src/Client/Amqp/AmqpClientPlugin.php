<?php

namespace App\Client\Amqp;

use App\Client\Amqp\Client\AmqpClient;
use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\Amqp\Publisher\PublisherFactory;
use App\Client\Amqp\Publisher\PublisherFactoryInterface;
use App\Client\Amqp\Receiver\ReceiverFactory;
use App\Client\Amqp\Receiver\ReceiverFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Amqp\TaskStatus\Core\Business\Client\Driver\ClientTaskStatusDriverFactoryInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class AmqpClientPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(AmqpClientInterface::class, function(
            AmqpFacadeInterface $amqpFacade,
            UuidFacadeInterface $uuidFacade,
            SerializerFacadeInterface $serializerFacade,
            ClientTaskStatusDriverFactoryInterface $clientTaskStatusDriverFactory
        ) {
            $publisherFactory = $this->createPublisherFactory($uuidFacade, $amqpFacade, $serializerFacade);
            $receiverFactory = $this->createReceiverFactory($serializerFacade, $clientTaskStatusDriverFactory);

            return $this->createClient($publisherFactory, $receiverFactory);
        });
    }

    /**
     * @param SerializerFacadeInterface $serializerFacade
     * @param ClientTaskStatusDriverFactoryInterface $clientTaskStatusDriverFactory
     *
     * @return ReceiverFactoryInterface
     */
    protected function createReceiverFactory(SerializerFacadeInterface $serializerFacade, ClientTaskStatusDriverFactoryInterface $clientTaskStatusDriverFactory): ReceiverFactoryInterface
    {
        return new ReceiverFactory($clientTaskStatusDriverFactory, $serializerFacade);
    }

    /**
     * @param PublisherFactoryInterface $publisherFactory
     * @param ReceiverFactoryInterface $receiverFactory
     *
     * @return AmqpClientInterface
     */
    protected function createClient(PublisherFactoryInterface $publisherFactory, ReceiverFactoryInterface $receiverFactory): AmqpClientInterface
    {
        return new AmqpClient(
            $publisherFactory,
            $receiverFactory
        );
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param AmqpFacadeInterface $amqpFacade
     * @param SerializerFacadeInterface $serializerFacade
     *
     * @return PublisherFactoryInterface
     */
    protected function createPublisherFactory(
        UuidFacadeInterface $uuidFacade,
        AmqpFacadeInterface $amqpFacade,
        SerializerFacadeInterface $serializerFacade
    ): PublisherFactoryInterface
    {
        return new PublisherFactory(
            $uuidFacade,
            $amqpFacade,
            $serializerFacade
        );
    }
}