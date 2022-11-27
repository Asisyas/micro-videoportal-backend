<?php

namespace App\Backend\VideoChannel\Business\Publisher;

use App\Backend\VideoChannel\Business\Manager\VideoChannelManagerInterface;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;

class Publisher implements PublisherInterface
{
    /**
     * @param VideoChannelManagerInterface $videoChannelManager
     * @param iterable<TransferPublisherInterface> $publisherCollection
     */
    public function __construct(
        private readonly VideoChannelManagerInterface $videoChannelManager,
        private readonly iterable $publisherCollection,
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function publish(VideoChannelGetTransfer $videoChannelGetTransfer): void
    {
        $channelTransfer = $this->videoChannelManager->lookupChannel($videoChannelGetTransfer);

        foreach ($this->publisherCollection as $publisher) {
            $publisher->publish($channelTransfer);
        }
    }
}