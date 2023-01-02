<?php

namespace App\Backend\ClientStorage;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\DTO\DTOPlugin;
use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Backend\ClientStorage\Business\Client\ClientFactoryInterface;
use App\Backend\ClientStorage\Business\Client\Redis\RedisClientFactory;
use App\Backend\ClientStorage\Facade\ClientStorageFacade;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use Micro\Plugin\Redis\RedisPlugin;

class ClientStoragePlugin implements DependencyProviderInterface, PluginDependedInterface, ConfigurableInterface
{
    use PluginConfigurationTrait;

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

    protected function createFacade(ClientFactoryInterface $clientFactory): ClientStorageFacadeInterface
    {
        return new ClientStorageFacade(
            clientFactory: $clientFactory,
        );
    }

    /**
     * @param RedisFacadeInterface $redisFacade
     * @param SerializerFacadeInterface $serializerFacade
     *
     * @return ClientFactoryInterface
     */
    protected function createClientFactory(
        RedisFacadeInterface $redisFacade,
        SerializerFacadeInterface $serializerFacade
    ): ClientFactoryInterface {
        return new RedisClientFactory($redisFacade, $serializerFacade);
    }

    public function getDependedPlugins(): iterable
    {
        return [
            RedisPlugin::class,
            DTOPlugin::class,
        ];
    }
}
