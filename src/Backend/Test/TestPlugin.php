<?php

namespace App\Backend\Test;

use App\Backend\File\Facade\FileFacadeInterface;
use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\Test\Command\ClassLocatorCommand;
use App\Backend\Test\Command\GenerateDashCommand;
use App\Backend\Test\Command\SagaCreateCommand;
use App\Backend\Test\Command\SagaExecuteCommand;
use App\Backend\Test\Command\SagaStatusCommand;
use App\Backend\Test\Command\TestSearchAddCommand;
use App\Backend\Test\Command\TestVideoSearchCommand;
use App\Backend\Test\Command\VideoConvertCommand;
use App\Backend\Test\Command\VideoCreateCommand;
use App\Backend\Test\Command\VideoExtractMetadataCommand;
use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Backend\Test\Command\VideoPropagateCommand;
use App\Backend\VideoPublish\Facade\VideoPublishFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Client\Search\Client\SearchClientInterface;
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
            new VideoPropagateCommand($container->get(VideoPublishFacadeInterface::class)),
            new TestVideoSearchCommand(
                $container->get(SearchClientInterface::class)
            ),
            new TestSearchAddCommand(
                $container->get(SearchStorageFacadeInterface::class),
                $container->get(VideoClientInterface::class)
            ),
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