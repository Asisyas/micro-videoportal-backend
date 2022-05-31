<?php

namespace App\Client\Amqp;

use App\Client\Amqp\Client\AmqpClient;
use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\Amqp\Publisher\PublisherFactory;
use App\Client\Amqp\Publisher\PublisherFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
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
            UuidFacadeInterface $uuidFacade
        ) {
            $publisherFactory = $this->createPublisherFactory($uuidFacade, $amqpFacade);

            return $this->createClient($publisherFactory);
        });
    }

    /**
     * @param PublisherFactoryInterface $publisherFactory
     *
     * @return AmqpClientInterface
     */
    public function createClient(PublisherFactoryInterface $publisherFactory): AmqpClientInterface
    {
        return new AmqpClient($publisherFactory);
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param AmqpFacadeInterface $amqpFacade
     *
     * @return PublisherFactoryInterface
     */
    protected function createPublisherFactory(UuidFacadeInterface $uuidFacade, AmqpFacadeInterface $amqpFacade): PublisherFactoryInterface
    {
        return new PublisherFactory(
            $uuidFacade,
            $amqpFacade
        );
    }
}