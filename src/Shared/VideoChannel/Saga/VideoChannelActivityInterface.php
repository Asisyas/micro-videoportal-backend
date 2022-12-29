<?php

namespace App\Shared\VideoChannel\Saga;

use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\VideoChannel\Exception\ChannelIdAlreadyExistsException;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface]
interface VideoChannelActivityInterface extends ActivityInterface
{
    /**
     * @param VideoChannelCreateTransfer $videoChannelCreateTransfer
     *
     * @return bool
     *
     * @throws ChannelIdAlreadyExistsException
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): bool;

    /**
     * @param VideoChannelGetTransfer $videoChannelGetTransfer
     *
     * @return bool
     */
    public function publishChannel(VideoChannelGetTransfer $videoChannelGetTransfer): bool;
}
