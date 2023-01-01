<?php

namespace App\Backend\Channel\VideoChannel\Business\Publisher;

use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;

interface PublisherInterface
{
    /**
     * @param VideoChannelGetTransfer $videoChannelGetTransfer
     *
     * @return void
     */
    public function publish(VideoChannelGetTransfer $videoChannelGetTransfer): void;
}
