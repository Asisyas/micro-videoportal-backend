<?php

namespace App\Shared\FsOperatorDecorator\Decorator;

use App\Shared\FsOperatorDecorator\Operator\FilesystemOperatorDecorator;
use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Filesystem\Configuration\FilesystemPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class FilesystemFacadeDecorator implements FilesystemFacadeInterface
{
    /**
     * @param FilesystemFacadeInterface $decorated
     */
    public function __construct(
        private readonly FilesystemFacadeInterface $decorated
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFsOperator(string $adapterName = FilesystemPluginConfigurationInterface::ADAPTER_DEFAULT): FilesystemOperator
    {
        $fs = $this->decorated->createFsOperator($adapterName);

        return new FilesystemOperatorDecorator($fs);
    }
}