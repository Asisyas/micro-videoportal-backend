<?php

namespace App\Backend\Test;

use App\Backend\Test\Command\ClassLocatorCommand;
use App\Backend\Test\Command\SagaCreateCommand;
use App\Backend\Test\Command\SagaExecuteCommand;
use App\Backend\Test\Command\VideoConvertCommand;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Console\CommandProviderInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class TestPlugin extends AbstractPlugin implements CommandProviderInterface
{
    public function provideDependencies(Container $container): void
    {
        parent::provideDependencies($container);
    }

    public function provideConsoleCommands(Container $container): array
    {
        return [
            new SagaExecuteCommand($container->get(TemporalFacadeInterface::class)),
            new SagaCreateCommand($container->get(TemporalFacadeInterface::class)),
            new VideoConvertCommand($container->get(FfmpegFacadeInterface::class)),
            new ClassLocatorCommand($container->get(LocatorFacadeInterface::class)),
        ];
    }
}