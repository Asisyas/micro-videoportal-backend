<?php

namespace App\Backend\Video\VideoPublish;

use App\Backend\ClientStorage\ClientStoragePlugin;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\SearchStorage\SearchStoragePlugin;
use App\Backend\Video\Video\Facade\VideoFacadeInterface;
use App\Backend\Video\Video\VideoPlugin;
use App\Backend\Video\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Expander\Impl\VideoDescriptionExpander;
use App\Backend\Video\VideoPublish\Business\Expander\Impl\VideoSourceExpander;
use App\Backend\Video\VideoPublish\Business\Expander\VideoWatchExpanderFactory;
use App\Backend\Video\VideoPublish\Business\Expander\VideoWatchExpanderFactoryInterface;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\Impl\ClientReaderPropagator;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\Impl\SearchIndexPropagator;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\Impl\VideoDescriptionPropagator;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorFactory;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorFactoryInterface;
use App\Backend\Video\VideoPublish\Business\Index\VideoIndexPropagateManagerFactory;
use App\Backend\Video\VideoPublish\Business\Index\VideoIndexPropagateManagerFactoryInterface;
use App\Backend\Video\VideoPublish\Facade\VideoPublishFacade;
use App\Backend\Video\VideoPublish\Facade\VideoPublishFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Temporal\TemporalPlugin;

class VideoPublishPlugin implements ConfigurableInterface, DependencyProviderInterface, PluginDependedInterface
{
    use PluginConfigurationTrait;

    /**
     * @var VideoFacadeInterface
     */
    private readonly VideoFacadeInterface $videoFacade;

    /**
     * @var VideoDescriptionFacadeInterface
     */
    private readonly VideoDescriptionFacadeInterface $videoDescriptionFacade;

    /**
     * @var SearchStorageFacadeInterface
     */
    private readonly SearchStorageFacadeInterface $searchStorageFacade;

    /**
     * @var ClientStorageFacadeInterface
     */
    private readonly ClientStorageFacadeInterface $clientStorageFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoPublishFacadeInterface::class, function (
            VideoFacadeInterface $videoFacade,
            VideoDescriptionFacadeInterface $videoDescriptionFacade,
            SearchStorageFacadeInterface $searchStorageFacade,
            ClientStorageFacadeInterface $clientStorageFacade,
        ) {
            $this->clientStorageFacade      = $clientStorageFacade;
            $this->searchStorageFacade      = $searchStorageFacade;
            $this->videoDescriptionFacade   = $videoDescriptionFacade;
            $this->videoFacade              = $videoFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoPublishFacadeInterface
     */
    public function createFacade(): VideoPublishFacadeInterface
    {
        return new VideoPublishFacade(
            $this->createVideoIndexPropagateManagerFactory(),
        );
    }

    /**
     * @return VideoIndexPropagateManagerFactoryInterface
     */
    public function createVideoIndexPropagateManagerFactory(): VideoIndexPropagateManagerFactoryInterface
    {
        return new VideoIndexPropagateManagerFactory(
            $this->createIndexPropagatorFactory(),
            $this->videoFacade
        );
    }

    /**
     * @return IndexPropagatorFactoryInterface
     */
    public function createIndexPropagatorFactory(): IndexPropagatorFactoryInterface
    {
        return new IndexPropagatorFactory(
            new ClientReaderPropagator($this->clientStorageFacade),
            new SearchIndexPropagator($this->searchStorageFacade),
            new VideoDescriptionPropagator($this->videoDescriptionFacade),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getDependedPlugins(): iterable
    {
        return [
            VideoPlugin::class,
            ClientStoragePlugin::class,
            SearchStoragePlugin::class,
            TemporalPlugin::class,
        ];
    }
}
