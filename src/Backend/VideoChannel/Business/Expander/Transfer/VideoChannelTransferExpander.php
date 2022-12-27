<?php

namespace App\Backend\VideoChannel\Business\Expander\Transfer;

use App\Shared\Generated\DTO\Video\VideoChannelTransfer;

class VideoChannelTransferExpander implements VideoChannelTransferExpanderInterface
{
    /**
     * @param iterable<VideoChannelTransferExpanderInterface> $channelExpanderCollection
     */
    public function __construct(
        private readonly iterable $channelExpanderCollection
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoChannelTransfer $videoChannelTransfer): void
    {
        foreach ($this->channelExpanderCollection as $expander) {
            $expander->expand($videoChannelTransfer);
        }
    }
}
