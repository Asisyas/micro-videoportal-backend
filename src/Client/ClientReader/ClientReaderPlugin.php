<?php

namespace App\Client\ClientReader;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Library\DTO\DtoFacadeInterface;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\DTO\DTOPlugin;
use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Client\ClientReader\Business\Client\ClientFactoryInterface;
use App\Client\ClientReader\Business\Client\Redis\RedisClientFactory;
use App\Client\ClientReader\Facade\ClientReaderFacade;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use Micro\Plugin\Redis\RedisPlugin;

class ClientReaderPlugin implements DependencyProviderInterface, PluginDependedInterface
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

    /**
     * @return ClientReaderFacadeInterface
     */
    protected function createFacade(): ClientReaderFacadeInterface
    {
        return new ClientReaderFacade($this->createClientFactory());
    }

    /**
     * @return ClientFactoryInterface
     */
    protected function createClientFactory(): ClientFactoryInterface
    {
        return new RedisClientFactory(
            $this->redisFacade,
            $this->serializerFacade
        );
    }

    public function getDependedPlugins(): iterable
    {
        return [
            DTOPlugin::class,
            RedisPlugin::class,
        ];
    }
}
