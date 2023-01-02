<?php

namespace App\Backend\SearchStorage;

use App\Backend\SearchStorage\Business\Storage\ElasticStorageFactory;
use App\Backend\SearchStorage\Business\Storage\StorageFactoryInterface;
use App\Backend\SearchStorage\Facade\SearchStorageFacade;
use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\DTO\DTOPlugin;
use Micro\Plugin\Elastic\ElasticPlugin;
use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

class SearchStoragePlugin implements DependencyProviderInterface, PluginDependedInterface, ConfigurableInterface
{
    use PluginConfigurationTrait;

    /**
     * @var ElasticFacadeInterface
     */
    private readonly ElasticFacadeInterface $elasticFacade;

    /**
     * @var SerializerFacadeInterface
     */
    private readonly SerializerFacadeInterface $serializerFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SearchStorageFacadeInterface::class, function (
            ElasticFacadeInterface $elasticFacade,
            SerializerFacadeInterface $serializerFacade
        ) {
            $this->elasticFacade = $elasticFacade;
            $this->serializerFacade = $serializerFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return SearchStorageFacadeInterface
     */
    protected function createFacade(): SearchStorageFacadeInterface
    {
        return new SearchStorageFacade(
            $this->createStorageFactory()
        );
    }

    /**
     * @return StorageFactoryInterface
     */
    protected function createStorageFactory(): StorageFactoryInterface
    {
        return new ElasticStorageFactory(
            $this->elasticFacade,
            $this->serializerFacade
        );
    }

    public function getDependedPlugins(): iterable
    {
        return [
            ElasticPlugin::class,
            DTOPlugin::class,
        ];
    }
}
