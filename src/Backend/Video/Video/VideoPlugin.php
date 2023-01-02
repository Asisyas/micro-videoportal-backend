<?php

namespace App\Backend\Video\Video;

use App\Backend\Video\Video\Business\Manager\VideoManagerFactory;
use App\Backend\Video\Video\Business\Manager\VideoManagerFactoryInterface;
use App\Backend\Video\Video\Facade\VideoFacade;
use App\Backend\Video\Video\Facade\VideoFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Doctrine\DoctrinePlugin;
use Micro\Plugin\Temporal\TemporalPlugin;

class VideoPlugin implements DependencyProviderInterface, PluginDependedInterface
{
    /**
     * @var DoctrineFacadeInterface
     */
    private readonly DoctrineFacadeInterface $doctrineFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoFacadeInterface::class, function (
            DoctrineFacadeInterface $doctrineFacade
        ) {
            $this->doctrineFacade = $doctrineFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoFacadeInterface
     */
    protected function createFacade(): VideoFacadeInterface
    {
        return new VideoFacade(
            $this->createVideoManagerFactory(),
        );
    }

    /**
     * @return VideoManagerFactoryInterface
     */
    protected function createVideoManagerFactory(): VideoManagerFactoryInterface
    {
        return new VideoManagerFactory(
            $this->doctrineFacade
        );
    }

    public function getDependedPlugins(): iterable
    {
        return [
            DoctrinePlugin::class,
            TemporalPlugin::class,
        ];
    }
}
