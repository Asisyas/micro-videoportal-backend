<?php

namespace App\Backend\Test;

use App\Backend\File\Facade\FileFacadeInterface;
use App\Backend\Test\Command\ClassLocatorCommand;
use App\Backend\Test\Command\GenerateDashCommand;
use App\Backend\Test\Command\SagaCreateCommand;
use App\Backend\Test\Command\SagaExecuteCommand;
use App\Backend\Test\Command\SagaStatusCommand;
use App\Backend\Test\Command\VideoConvertCommand;
use App\Backend\Test\Command\VideoCreateCommand;
use App\Backend\Test\Command\VideoExtractMetadataCommand;
use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Client\Video\Client\VideoClientInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Console\CommandProviderInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
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
            new SagaStatusCommand($container->get(TemporalFacadeInterface::class)),
            new SagaCreateCommand($container->get(TemporalFacadeInterface::class)),
            new ClassLocatorCommand($container->get(LocatorFacadeInterface::class)),
            new SagaExecuteCommand($container->get(TemporalFacadeInterface::class)),
            new GenerateDashCommand(
                $container->get(MediaConverterFacadeInterface::class),
            ),
            new VideoCreateCommand(
                $container->get(VideoClientInterface::class),
            ),
            new VideoConvertCommand(
                $container->get(MediaConverterFacadeInterface::class),
                $container->get(FileClientInterface::class)
            ),
            new VideoExtractMetadataCommand(
                $container->get(MediaConverterFacadeInterface::class),
                $container->get(FileClientInterface::class)
            )
        ];
    }
}