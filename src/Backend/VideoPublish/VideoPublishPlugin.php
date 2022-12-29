<?php

namespace App\Backend\VideoPublish;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\Video\Facade\VideoFacadeInterface;
use App\Backend\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Backend\VideoPublish\Business\Expander\Impl\VideoDescriptionExpander;
use App\Backend\VideoPublish\Business\Expander\Impl\VideoSourceExpander;
use App\Backend\VideoPublish\Business\Expander\VideoWatchExpanderFactory;
use App\Backend\VideoPublish\Business\Expander\VideoWatchExpanderFactoryInterface;
use App\Backend\VideoPublish\Business\Factory\VideoWatchTransferFactory;
use App\Backend\VideoPublish\Business\Factory\VideoWatchTransferFactoryInterface;
use App\Backend\VideoPublish\Business\Index\Propagator\Impl\ClientReaderPropagator;
use App\Backend\VideoPublish\Business\Index\Propagator\Impl\SearchIndexPropagator;
use App\Backend\VideoPublish\Business\Index\Propagator\IndexPropagatorFactory;
use App\Backend\VideoPublish\Business\Index\Propagator\IndexPropagatorFactoryInterface;
use App\Backend\VideoPublish\Business\Index\VideoIndexPropagateManagerFactory;
use App\Backend\VideoPublish\Business\Index\VideoIndexPropagateManagerFactoryInterface;
use App\Backend\VideoPublish\Facade\VideoPublishFacade;
use App\Backend\VideoPublish\Facade\VideoPublishFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoPublishPlugin extends AbstractPlugin
{
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
            ClientStorageFacadeInterface $clientStorageFacade
        ) {
            $this->clientStorageFacade      = $clientStorageFacade;
            $this->searchStorageFacade      = $searchStorageFacade;
            $this->videoDescriptionFacade   = $videoDescriptionFacade;
            $this->videoFacade              = $videoFacade;

            return $this->createFacade();
        });
    }

    public function createFacade(): VideoPublishFacade
    {
        return new VideoPublishFacade(
            $this->createVideoIndexPropagateManagerFactory(),
        );
    }

    public function createVideoWatchExpanderFactory(): VideoWatchExpanderFactory
    {
        return new VideoWatchExpanderFactory(
            new VideoSourceExpander($this->videoFacade),
            new VideoDescriptionExpander($this->videoDescriptionFacade)
        );
    }

    public function createVideoWatchTransferFactory(): VideoWatchTransferFactory
    {
        return new VideoWatchTransferFactory(
            $this->createVideoWatchExpanderFactory()
        );
    }

    public function createVideoIndexPropagateManagerFactory(): VideoIndexPropagateManagerFactory
    {
        return new VideoIndexPropagateManagerFactory(
            $this->createIndexPropagatorFactory(),
            $this->createVideoWatchTransferFactory()
        );
    }

    public function createIndexPropagatorFactory(): IndexPropagatorFactory
    {
        return new IndexPropagatorFactory(
            new ClientReaderPropagator($this->clientStorageFacade),
            new SearchIndexPropagator($this->searchStorageFacade)
        );
    }
}
