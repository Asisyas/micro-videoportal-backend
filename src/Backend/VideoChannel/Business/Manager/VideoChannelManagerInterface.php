<?php

namespace App\Backend\VideoChannel\Business\Manager;

use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Exception\ChannelIdAlreadyExistsException;

interface VideoChannelManagerInterface
{
    /**
     * @param VideoChannelCreateTransfer $videoChannelCreateTransfer
     *
     * @return void
     *
     * @throws ChannelIdAlreadyExistsException
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): void;

    /**
     * @param VideoChannelGetTransfer $videoChannelGetTransfer
     *
     * @return VideoChannelTransfer
     */
    public function lookupChannel(VideoChannelGetTransfer $videoChannelGetTransfer): VideoChannelTransfer;
}
