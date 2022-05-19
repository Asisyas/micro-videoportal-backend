<?php

namespace App\Client\DataSource;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\DataSource\Client\DataSourceClient;
use App\Client\DataSource\Client\DataSourceClientInterface;

class DataSourceClientPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(DataSourceClientInterface::class, function (Container $container) {
            return new DataSourceClient($container->get(ClientReaderFacadeInterface::class));
        });
    }
}