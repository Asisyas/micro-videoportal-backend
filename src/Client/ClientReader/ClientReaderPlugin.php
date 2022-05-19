<?php

namespace App\Client\ClientReader;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Client\ClientReader\Business\Client\ClientFactoryInterface;
use App\Client\ClientReader\Business\Client\Redis\RedisClientFactory;
use App\Client\ClientReader\Facade\ClientReaderFacade;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;

class ClientReaderPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ClientReaderFacadeInterface::class, function (RedisFacadeInterface $redisFacade) {
            return $this->createFacade($redisFacade);
        });
    }

    /**
     * @param RedisFacadeInterface $redisFacade
     *
     * @return ClientReaderFacadeInterface
     */
    protected function createFacade(RedisFacadeInterface $redisFacade): ClientReaderFacadeInterface
    {
        return new ClientReaderFacade($this->createClientFactory($redisFacade));
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