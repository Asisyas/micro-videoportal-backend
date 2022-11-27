<?php

namespace App\Backend\VideoChannel\Business\Publisher;

use App\Shared\Generated\DTO\Video\VideoChannelTransfer;

interface TransferPublisherInterface
{
    /**
     * @param VideoChannelTransfer $videoChannelTransfer
     *
     * @return void
     */
    public function publish(VideoChannelTransfer $videoChannelTransfer): void;
}