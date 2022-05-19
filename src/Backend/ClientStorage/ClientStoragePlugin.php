<?php

namespace App\Backend\ClientStorage;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
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
        $container->register(ClientStorageFacadeInterface::class, function (RedisFacadeInterface $redisFacade) {
            return $this->createFacade($redisFacade);
        });
    }

    protected function createFacade(RedisFacadeInterface $redisFacade): ClientStorageFacadeInterface
    {
        return new ClientStorageFacade(
            clientFactory: $this->createClientFactory($redisFacade)
        );
    }

    /**
     * @param RedisFacadeInterface $redisFacade
     *
     * @return ClientFactoryInterface
     */
    protected function createClientFactory(RedisFacadeInterface $redisFacade): ClientFactoryInterface
    {
        return new RedisClientFactory($redisFacade);
    }
}