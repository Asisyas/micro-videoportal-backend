<?php

namespace App\Backend\DataSource;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Console\CommandProviderInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\DataSource\Business\Expander\DataSource\DataSourceExpanderFactory;
use App\Backend\DataSource\Business\Expander\DataSource\DataSourceExpanderFactoryInterface;
use App\Backend\DataSource\Business\Expander\DataSource\Processor\EntityBasicFieldsProcessor;
use App\Backend\DataSource\Business\Factory\DataSourceFactory;
use App\Backend\DataSource\Business\Factory\DataSourceFactoryInterface;
use App\Backend\DataSource\Business\Transformer\DataSource\DataSourceFromEntityTransformer;
use App\Backend\DataSource\Business\Transformer\DataSource\DataSourceTransformerInterface;
use App\Backend\DataSource\Console\CreateDataSourceCommand;
use App\Backend\DataSource\Console\ViewDataSourceCommand;
use App\Backend\DataSource\Facade\DataSourceFacade;
use App\Client\DataSource\Client\DataSourceClientInterface;
use App\Shared\DataSource\Facade\DataSourceFacadeInterface;

class DataSourcePlugin extends AbstractPlugin implements CommandProviderInterface
{
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $this->container = $container;

        $container->register(DataSourceFacadeInterface::class, function (Container $container) {
            return $this->createFacade();
        });
    }

    /**
     * @return DataSourceFacadeInterface
     */
    protected function createFacade(): DataSourceFacadeInterface
    {
        return new DataSourceFacade(
            dataSourceFactory: $this->createDataSourceFactory()
        );
    }

    /**
     * @return DataSourceFactoryInterface
     */
    protected function createDataSourceFactory(): DataSourceFactoryInterface
    {
        return new DataSourceFactory(
            uuidFacade: $this->container->get(UuidFacadeInterface::class),
            doctrineFacade: $this->container->get(DoctrineFacadeInterface::class),
            dataSourceTransformer: $this->createDataSourceTransformer(),
            clientStorageFacade: $this->container->get(ClientStorageFacadeInterface::class)
        );
    }

    /**
     * @return DataSourceTransformerInterface
     */
    protected function createDataSourceTransformer(): DataSourceTransformerInterface
    {
        return new DataSourceFromEntityTransformer(
            dataSourceExpanderFactory: $this->createDataSourceExpanderFactory()
        );
    }

    /**
     * @return DataSourceExpanderFactoryInterface
     */
    protected function createDataSourceExpanderFactory(): DataSourceExpanderFactoryInterface
    {
        return new DataSourceExpanderFactory([
            new EntityBasicFieldsProcessor(),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function provideConsoleCommands(Container $container): array
    {
        return [
            new CreateDataSourceCommand($container->get(DataSourceFacadeInterface::class)),
            new ViewDataSourceCommand($container->get(DataSourceClientInterface::class)),
        ];
    }
}