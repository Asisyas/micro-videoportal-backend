<?php

namespace App\Frontend\VideoChannel\Facade;

use App\Frontend\VideoChannel\Handler\Create\ChannelCreateRequestHandlerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoChannelFacade implements VideoChannelFacadeInterface
{
    /**
     * @param ChannelCreateRequestHandlerFactoryInterface $channelCreateRequestHandlerFactory
     */
    public function __construct(
        private readonly ChannelCreateRequestHandlerFactoryInterface $channelCreateRequestHandlerFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function handleChannelCreateFromRequest(Request $request): VideoChannelTransfer
    {
        return $this->channelCreateRequestHandlerFactory
            ->create()
            ->handleChannelCreateFromRequest($request);
    }
}
