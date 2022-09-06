<?php

namespace App\Frontend\File;

use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\File\Facade\FileFacade;
use App\Frontend\File\Facade\FileFacadeInterface;
use App\Frontend\File\Validator\Stream\CreateStreamRequestValidatorFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class FilePlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(FileFacadeInterface::class, function () {
            return $this->createFacade();
        });
    }

    /**
     * @return FileFacadeInterface
     */
    protected function createFacade(): FileFacadeInterface
    {
        return new FileFacade(
            $this->createCreateStreamRequestValidatorFactory(),
        );
    }

    /**
     * @return ArrayValidatorFactoryInterface
     */
    protected function createCreateStreamRequestValidatorFactory(): ArrayValidatorFactoryInterface
    {
        return new CreateStreamRequestValidatorFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginFrontend';
    }
}