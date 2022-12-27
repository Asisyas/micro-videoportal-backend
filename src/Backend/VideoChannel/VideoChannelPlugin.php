<?php

namespace App\Backend\VideoChannel;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\VideoChannel\Business\Expander\Entity\Impl\DefaultsExpander as EntityDefaultsExpander;
use App\Backend\VideoChannel\Business\Expander\Entity\VideoChannelEntityExpanderFactory;
use App\Backend\VideoChannel\Business\Expander\Entity\VideoChannelEntityExpanderFactoryInterface;
use App\Backend\VideoChannel\Business\Expander\Transfer\Impl\DefaultsExpander as TransferDefaultsExpander;
use App\Backend\VideoChannel\Business\Expander\Transfer\VideoChannelTransferExpanderFactory;
use App\Backend\VideoChannel\Business\Expander\Transfer\VideoChannelTransferExpanderFactoryInterface;
use App\Backend\VideoChannel\Business\Manager\VideoChannelManagerFactory;
use App\Backend\VideoChannel\Business\Manager\VideoChannelManagerFactoryInterface;
use App\Backend\VideoChannel\Business\Publisher\Impl\ClientReaderPublisher;
use App\Backend\VideoChannel\Business\Publisher\Impl\SearchIndexPublisher;
use App\Backend\VideoChannel\Business\Publisher\PublisherFactory;
use App\Backend\VideoChannel\Business\Publisher\PublisherFactoryInterface;
use App\Backend\VideoChannel\Business\Publisher\TransferPublisherInterface;
use App\Backend\VideoChannel\Facade\VideoChannelFacade;
use App\Backend\VideoChannel\Facade\VideoChannelFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class VideoChannelPlugin extends AbstractPlugin
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
        ];
    }
}
