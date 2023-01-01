<?php

namespace App\Backend\Channel\VideoChannel\Business\Publisher;

use App\Backend\Channel\VideoChannel\Business\Manager\VideoChannelManagerFactoryInterface;

class PublisherFactory implements PublisherFactoryInterface
{
    /**
     * @var iterable<TransferPublisherInterface>
     */
    private readonly iterable $publisherCollection;

    /**
     * @param VideoChannelManagerFactoryInterface $videoChannelManagerFactory
     * @param TransferPublisherInterface ...$publisherCollection
     */
    public function __construct(
        private readonly VideoChannelManagerFactoryInterface $videoChannelManagerFactory,
        TransferPublisherInterface ...$publisherCollection
    ) {
        $this->publisherCollection = $publisherCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): PublisherInterface
    {
        return new Publisher(
            $this->videoChannelManagerFactory->create(),
            $this->publisherCollection
        );
    }
}
