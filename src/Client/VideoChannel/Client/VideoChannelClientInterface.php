<?php

namespace App\Client\VideoChannel\Client;

use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;

interface VideoChannelClientInterface
{
    /**
     * @param VideoChannelCreateTransfer $videoChannelCreateTransfer
     *
     * @return VideoChannelTransfer
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): VideoChannelTransfer;

    /**
     * @param VideoChannelGetTransfer $videoChannelGetTransfer
     *
     * @return VideoChannelTransfer
     */
    public function lookupChannel(VideoChannelGetTransfer $videoChannelGetTransfer): VideoChannelTransfer;
}