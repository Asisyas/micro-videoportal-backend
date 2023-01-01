<?php

namespace App\Shared\FsOperatorDecorator;

use App\Shared\FsOperatorDecorator\Decorator\FilesystemFacadeDecorator;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Filesystem\Adapter\Aws\FilesystemS3AdapterPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Filesystem\FilesystemPlugin;

class FsOperatorDecoratorPlugin implements DependencyProviderInterface, PluginDependedInterface
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->decorate(FilesystemFacadeInterface::class, function (
            FilesystemFacadeInterface $decorated
        ) {
            return $this->createDecorator($decorated);
        });
    }

    /**
     * @param FilesystemFacadeInterface $filesystemFacade
     *
     * @return FilesystemFacadeInterface
     */
    protected function createDecorator(FilesystemFacadeInterface $filesystemFacade): FilesystemFacadeInterface
    {
        return new FilesystemFacadeDecorator($filesystemFacade);
    }

    /**
     * {@inheritDoc}
     */
    public function getDependedPlugins(): iterable
    {
        return [
            FilesystemPlugin::class,
        ];
    }
}
