<?php

namespace App\Backend\Channel\VideoChannel\Business\Expander\Entity;

use App\Backend\Channel\VideoChannel\Entity\VideoChannel;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;

interface VideoChannelEntityExpanderInterface
{
    /**
     * @param VideoChannel $videoChannel
     * @param VideoChannelCreateTransfer $channelCreateTransfer
     * @return void
     */
    public function expand(
        VideoChannel $videoChannel,
        VideoChannelCreateTransfer $channelCreateTransfer
    ): void;
}
