<?php

namespace App\Client\ClientReader;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Client\ClientReader\Business\Client\ClientFactoryInterface;
use App\Client\ClientReader\Business\Client\Redis\RedisClientFactory;
use App\Client\ClientReader\Facade\ClientReaderFacade;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;

class ClientReaderPlugin extends AbstractPlugin
{
    /**
     * @var RedisFacadeInterface
     */
    private readonly RedisFacadeInterface $redisFacade;

    /**
     * @var SerializerFacadeInterface
     */
    private readonly SerializerFacadeInterface $serializerFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ClientReaderFacadeInterface::class, function (
            RedisFacadeInterface $redisFacade,
            SerializerFacadeInterface $serializerFacade
        ) {
            $this->redisFacade = $redisFacade;
            $this->serializerFacade = $serializerFacade;

            return $this->createFacade();
        });
    }

    protected function createFacade(): ClientReaderFacade
    {
        return new ClientReaderFacade($this->createClientFactory());
    }

    protected function createClientFactory(): RedisClientFactory
    {
        return new RedisClientFactory(
            $this->redisFacade,
            $this->serializerFacade
        );
    }
}
