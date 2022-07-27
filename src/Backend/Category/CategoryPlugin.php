<?php

namespace App\Backend\Category;

use App\Backend\Category\Business\Action\ActionProcessorFactory;
use App\Backend\Category\Business\Action\ActionProcessorFactoryInterface;
use App\Backend\Category\Business\Action\ClientStorage\UpdateClientStorageFactory;
use App\Backend\Category\Business\Expander\CategoryTransfer\CategoryTransferExpanderFactory;
use App\Backend\Category\Business\Expander\CategoryTransfer\CategoryTransferExpanderFactoryInterface;
use App\Backend\Category\Business\Expander\CategoryTransfer\Expander\BaseFieldExpander;
use App\Backend\Category\Business\Expander\CategoryTransfer\Expander\ParentCategoryExpander;
use App\Backend\Category\Business\Factory\CategoryFactory;
use App\Backend\Category\Business\Factory\CategoryFactoryInterface;
use App\Backend\Category\Business\Storage\StorageManagerFactory;
use App\Backend\Category\Business\Storage\StorageManagerFactoryInterface;
use App\Backend\Category\Consumer\CategoryConsumer;
use App\Backend\Category\Facade\CategoryFacade;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Shared\Category\Configuration;
use App\Shared\Category\Facade\CategoryFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerConfigurationInterface;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerProcessorInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;
use Psr\Container\ContainerInterface;

class CategoryPlugin extends AbstractPlugin
{
    /**
     * @var Container
     */
    protected ContainerInterface $container;

    /**
     * @var StorageManagerFactoryInterface|null
     */
    protected ?StorageManagerFactoryInterface $storageManagerFactory = null;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(Configuration::SERVICE_FACADE_BACKEND, function () {
            return $this->createFacade();
        });
    }

    /**
     * @return CategoryFacadeInterface
     */
    protected function createFacade(): CategoryFacadeInterface
    {
        return new CategoryFacade(
            $this->createCategoryFactory()
        );
    }

    /**
     * @return CategoryFactoryInterface
     */
    protected function createCategoryFactory(): CategoryFactoryInterface
    {
        return new CategoryFactory(
            $this->container->get(DoctrineFacadeInterface::class),
            $this->container->get(UuidFacadeInterface::class),
            $this->createCategoryTransferExpanderFactory(),
            $this->createPostSaveProcessorFactory()
        );
    }

    /**
     * @return CategoryTransferExpanderFactoryInterface
     */
    protected function createCategoryTransferExpanderFactory(): CategoryTransferExpanderFactoryInterface
    {
        return new CategoryTransferExpanderFactory([
            new BaseFieldExpander(),
            new ParentCategoryExpander(),
        ]);
    }

    protected function createPostSaveProcessorFactory(): ActionProcessorFactoryInterface
    {
        return new ActionProcessorFactory(
            new UpdateClientStorageFactory($this->createStorageManagerFactory())
        );
    }

    /**
     * @return StorageManagerFactoryInterface
     */
    protected function createStorageManagerFactory(): StorageManagerFactoryInterface
    {
        if(!$this->storageManagerFactory) {
            $this->storageManagerFactory = new StorageManagerFactory($this->container->get(ClientStorageFacadeInterface::class));
        }

        return $this->storageManagerFactory;
    }
}