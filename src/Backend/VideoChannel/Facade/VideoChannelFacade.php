<?php

namespace App\Backend\VideoChannel\Facade;

use App\Backend\VideoChannel\Business\Manager\VideoChannelManagerFactoryInterface;
use App\Backend\VideoChannel\Business\Publisher\PublisherFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;

class VideoChannelFacade implements VideoChannelFacadeInterface
{
    /**
     * @param VideoChannelManagerFactoryInterface $videoChannelManagerFactory
     * @param PublisherFactoryInterface $publisherFactory
     */
    public function __construct(
        private readonly VideoChannelManagerFactoryInterface $videoChannelManagerFactory,
        private readonly PublisherFactoryInterface $publisherFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): void
    {
        $this->videoChannelManagerFactory
            ->create()
            ->createChannel($videoChannelCreateTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function lookupChannel(VideoChannelGetTransfer $videoChannelGetTransfer): VideoChannelTransfer
    {
        return $this->videoChannelManagerFactory
            ->create()
            ->lookupChannel($videoChannelGetTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function publish(VideoChannelGetTransfer $videoChannelGetTransfer): void
    {
        $this->publisherFactory
            ->create()
            ->publish($videoChannelGetTransfer);
    }
}