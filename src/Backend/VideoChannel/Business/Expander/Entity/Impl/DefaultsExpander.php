<?php

namespace App\Backend\VideoChannel\Business\Expander\Entity\Impl;

use App\Backend\VideoChannel\Business\Expander\Entity\VideoChannelEntityExpanderInterface;
use App\Backend\VideoChannel\Entity\VideoChannel;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;

class DefaultsExpander implements VideoChannelEntityExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(VideoChannel $videoChannel, VideoChannelCreateTransfer $channelCreateTransfer): void
    {
        $videoChannel->setTitle($channelCreateTransfer->getTitle());
    }
}
