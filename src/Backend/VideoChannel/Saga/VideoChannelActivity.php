<?php

namespace App\Backend\VideoChannel\Saga;

use App\Backend\VideoChannel\Facade\VideoChannelFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\VideoChannel\Saga\VideoChannelActivityInterface;

class VideoChannelActivity implements VideoChannelActivityInterface
{
    /**
     * @param VideoChannelFacadeInterface $videoChannelFacade
     */
    public function __construct(private readonly VideoChannelFacadeInterface $videoChannelFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): bool
    {
        $this->videoChannelFacade->createChannel($videoChannelCreateTransfer);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function publishChannel(VideoChannelGetTransfer $videoChannelGetTransfer): bool
    {
        $this->videoChannelFacade->publish($videoChannelGetTransfer);

        return true;
    }
}
