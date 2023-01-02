<?php

namespace App\Backend\Channel\VideoChannel;

use App\Backend\Channel\VideoChannel\Business\Expander\Entity\Impl\DefaultsExpander as EntityDefaultsExpander;
use App\Backend\Channel\VideoChannel\Business\Expander\Entity\VideoChannelEntityExpanderFactory;
use App\Backend\Channel\VideoChannel\Business\Expander\Entity\VideoChannelEntityExpanderFactoryInterface;
use App\Backend\Channel\VideoChannel\Business\Expander\Transfer\Impl\DefaultsExpander as TransferDefaultsExpander;
use App\Backend\Channel\VideoChannel\Business\Expander\Transfer\VideoChannelTransferExpanderFactory;
use App\Backend\Channel\VideoChannel\Business\Expander\Transfer\VideoChannelTransferExpanderFactoryInterface;
use App\Backend\Channel\VideoChannel\Business\Manager\VideoChannelManagerFactory;
use App\Backend\Channel\VideoChannel\Business\Manager\VideoChannelManagerFactoryInterface;
use App\Backend\Channel\VideoChannel\Business\Publisher\Impl\ClientReaderPublisher;
use App\Backend\Channel\VideoChannel\Business\Publisher\Impl\SearchIndexPublisher;
use App\Backend\Channel\VideoChannel\Business\Publisher\Impl\ChannelRelationReaderPublisher;
use App\Backend\Channel\VideoChannel\Business\Publisher\PublisherFactory;
use App\Backend\Channel\VideoChannel\Business\Publisher\PublisherFactoryInterface;
use App\Backend\Channel\VideoChannel\Business\Publisher\TransferPublisherInterface;
use App\Backend\Channel\VideoChannel\Facade\VideoChannelFacade;
use App\Backend\Channel\VideoChannel\Facade\VideoChannelFacadeInterface;
use App\Backend\ClientStorage\ClientStoragePlugin;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\SearchStorage\SearchStoragePlugin;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Doctrine\DoctrinePlugin;
use Micro\Plugin\Temporal\TemporalPlugin;

class VideoChannelPlugin implements DependencyProviderInterface, PluginDependedInterface
{
    /**
     * @var DoctrineFacadeInterface
     */
    private readonly DoctrineFacadeInterface $doctrineFacade;

    /**
     * @var VideoChannelManagerFactoryInterface
     */
    private readonly VideoChannelManagerFactoryInterface $videoChannelManagerFactory;

    /**
     * @var ClientStorageFacadeInterface
     */
    private readonly ClientStorageFacadeInterface $clientStorageFacade;

    /**
     * @var SearchStorageFacadeInterface
     */
    private readonly SearchStorageFacadeInterface $searchStorageFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoChannelFacadeInterface::class, function (
            DoctrineFacadeInterface $doctrineFacade,
            ClientStorageFacadeInterface $clientStorageFacade,
            SearchStorageFacadeInterface $searchStorageFacade
        ) {
            $this->doctrineFacade               = $doctrineFacade;
            $this->searchStorageFacade          = $searchStorageFacade;
            $this->clientStorageFacade          = $clientStorageFacade;
            $this->videoChannelManagerFactory   = $this->createVideoChannelManagerFactory();

            return $this->createFacade();
        });
    }

    /**
     * @return VideoChannelFacadeInterface
     */
    public function createFacade(): VideoChannelFacadeInterface
    {
        return new VideoChannelFacade(
            $this->videoChannelManagerFactory,
            $this->createPublisherFactory()
        );
    }

    /**
     * @return VideoChannelTransferExpanderFactoryInterface
     */
    protected function createVideoChannelTransferExpanderFactory(): VideoChannelTransferExpanderFactoryInterface
    {
        return new VideoChannelTransferExpanderFactory(
            new TransferDefaultsExpander($this->doctrineFacade->getManager())
        );
    }

    /**
     * @return VideoChannelEntityExpanderFactoryInterface
     */
    protected function createVideoChannelEntityExpanderFactory(): VideoChannelEntityExpanderFactoryInterface
    {
        return new VideoChannelEntityExpanderFactory(
            new EntityDefaultsExpander()
        );
    }

    /**
     * @return VideoChannelManagerFactoryInterface
     */
    protected function createVideoChannelManagerFactory(): VideoChannelManagerFactoryInterface
    {
        return new VideoChannelManagerFactory(
            $this->doctrineFacade,
            $this->createVideoChannelEntityExpanderFactory(),
            $this->createVideoChannelTransferExpanderFactory(),
        );
    }

    /**
     * @return PublisherFactoryInterface
     */
    protected function createPublisherFactory(): PublisherFactoryInterface
    {
        return new PublisherFactory(
            $this->videoChannelManagerFactory,
            ...$this->createPublisherCollection(),
        );
    }

    /**
     * @return iterable<TransferPublisherInterface>
     */
    protected function createPublisherCollection(): iterable
    {
        return [
            new ClientReaderPublisher($this->clientStorageFacade),
            new SearchIndexPublisher($this->searchStorageFacade),
            new ChannelRelationReaderPublisher($this->clientStorageFacade)
        ];
    }

    public function getDependedPlugins(): iterable
    {
        return [
            DoctrinePlugin::class,
            ClientStoragePlugin::class,
            SearchStoragePlugin::class,
            TemporalPlugin::class,
        ];
    }
}
