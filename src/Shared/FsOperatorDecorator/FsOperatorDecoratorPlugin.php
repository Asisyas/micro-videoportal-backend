<?php

namespace App\Shared\FsOperatorDecorator;

use App\Shared\FsOperatorDecorator\Decorator\FilesystemFacadeDecorator;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class FsOperatorDecoratorPlugin extends AbstractPlugin
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
     */
    protected function createDecorator(FilesystemFacadeInterface $filesystemFacade): FilesystemFacadeDecorator
    {
        return new FilesystemFacadeDecorator($filesystemFacade);
    }
}
