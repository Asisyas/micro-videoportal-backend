<?php

namespace App\Backend\VideoChannel\Business\Expander\Entity;

use App\Backend\VideoChannel\Entity\VideoChannel;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;

class VideoChannelEntityExpander implements VideoChannelEntityExpanderInterface
{
    /**
     * @param iterable<VideoChannelEntityExpanderInterface> $expanderCollection
     */
    public function __construct(
        private readonly iterable $expanderCollection
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoChannel $videoChannel, VideoChannelCreateTransfer $channelCreateTransfer): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($videoChannel, $channelCreateTransfer);
        }
    }
}
