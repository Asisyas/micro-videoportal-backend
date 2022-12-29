<?php

namespace App\Backend\SearchStorage;

use App\Backend\SearchStorage\Business\Storage\ElasticStorageFactory;
use App\Backend\SearchStorage\Business\Storage\StorageFactoryInterface;
use App\Backend\SearchStorage\Facade\SearchStorageFacade;
use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

class SearchStoragePlugin extends AbstractPlugin
{
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

    protected function createFacade(): SearchStorageFacade
    {
        return new SearchStorageFacade(
            $this->createStorageFactory()
        );
    }

    protected function createStorageFactory(): ElasticStorageFactory
    {
        return new ElasticStorageFactory(
            $this->elasticFacade,
            $this->serializerFacade
        );
    }
}
