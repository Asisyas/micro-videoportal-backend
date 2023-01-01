<?php

namespace App\Backend\Video\VideoDescription;

use App\Backend\Video\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderFactory;
use App\Backend\Video\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderFactoryInterface;
use App\Backend\Video\VideoDescription\Business\Factory\Entity\VideoDescriptionEntityFactory;
use App\Backend\Video\VideoDescription\Business\Factory\Entity\VideoDescriptionEntityFactoryInterface;
use App\Backend\Video\VideoDescription\Business\Factory\Transfer\VideoDescriptionTransferFactory;
use App\Backend\Video\VideoDescription\Business\Factory\Transfer\VideoDescriptionTransferFactoryInterface;
use App\Backend\Video\VideoDescription\Business\Manager\VideoDescriptionManagerFactory;
use App\Backend\Video\VideoDescription\Business\Manager\VideoDescriptionManagerFactoryInterface;
use App\Backend\Video\VideoDescription\Facade\VideoDescriptionFacade;
use App\Backend\Video\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Doctrine\DoctrinePlugin;
use Micro\Plugin\Temporal\TemporalPlugin;

class VideoDescriptionPlugin implements DependencyProviderInterface, PluginDependedInterface
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
        $container->register(VideoDescriptionFacadeInterface::class, function (
            DoctrineFacadeInterface $doctrineFacade
        ) {
            $this->doctrineFacade = $doctrineFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoDescriptionFacadeInterface
     */
    public function createFacade(): VideoDescriptionFacadeInterface
    {
        return new VideoDescriptionFacade(
            $this->createVideoDescriptionManagerFactory(),
        );
    }

    protected function createVideoDescriptionManagerFactory(): VideoDescriptionManagerFactoryInterface
    {
        $expanderFactory = $this->createVideoDescriptionEntityExpanderFactory();

        return new VideoDescriptionManagerFactory(
            $this->doctrineFacade,
            $this->createVideoDescriptionEntityFactory($expanderFactory),
            $this->createVideoDescriptionTransferFactory(),
            $expanderFactory
        );
    }

    /**
     * @param VideoDescriptionEntityExpanderFactoryInterface $expanderFactory
     * @return VideoDescriptionEntityFactoryInterface
     */
    protected function createVideoDescriptionEntityFactory(
        VideoDescriptionEntityExpanderFactoryInterface $expanderFactory
    ): VideoDescriptionEntityFactoryInterface {
        return new VideoDescriptionEntityFactory($expanderFactory);
    }

    /**
     * @return VideoDescriptionTransferFactoryInterface
     */
    protected function createVideoDescriptionTransferFactory(): VideoDescriptionTransferFactoryInterface
    {
        return new VideoDescriptionTransferFactory();
    }

    /**
     * @return VideoDescriptionEntityExpanderFactoryInterface
     */
    protected function createVideoDescriptionEntityExpanderFactory(): VideoDescriptionEntityExpanderFactoryInterface
    {
        return new VideoDescriptionEntityExpanderFactory();
    }

    public function getDependedPlugins(): iterable
    {
        return [
            DoctrinePlugin::class,
            TemporalPlugin::class,
        ];
    }
}
