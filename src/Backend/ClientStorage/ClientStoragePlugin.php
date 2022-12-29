<?php

namespace App\Backend\ClientStorage;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Backend\ClientStorage\Business\Client\ClientFactoryInterface;
use App\Backend\ClientStorage\Business\Client\Redis\RedisClientFactory;
use App\Backend\ClientStorage\Facade\ClientStorageFacade;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;

class ClientStoragePlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ClientStorageFacadeInterface::class, function (
            RedisFacadeInterface $redisFacade,
            SerializerFacadeInterface $serializerFacade
        ) {
            $clientFactory = $this->createClientFactory(
                $redisFacade,
                $serializerFacade
            );

            return $this->createFacade($clientFactory);
        });
    }

    protected function createFacade(ClientFactoryInterface $clientFactory): ClientStorageFacade
    {
        return new ClientStorageFacade(
            clientFactory: $clientFactory,
        );
    }

    /**
     * @param RedisFacadeInterface $redisFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    protected function createClientFactory(
        RedisFacadeInterface $redisFacade,
        SerializerFacadeInterface $serializerFacade
    ): RedisClientFactory {
        return new RedisClientFactory($redisFacade, $serializerFacade);
    }
}
