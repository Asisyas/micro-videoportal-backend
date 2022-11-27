<?php

namespace App\Frontend\VideoChannel\Controller;

use App\Frontend\VideoChannel\Facade\VideoChannelFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoChannelController
{
    /**
     * @param VideoChannelFacadeInterface $videoChannelFacade
     */
    public function __construct(
        private readonly VideoChannelFacadeInterface $videoChannelFacade
    )
    {
    }

    /**
     * @param Request $request
     *
     * @return VideoChannelTransfer
     */
    public function createChannel(Request $request): VideoChannelTransfer
    {
        return $this->videoChannelFacade->handleChannelCreateFromRequest($request);
    }
}