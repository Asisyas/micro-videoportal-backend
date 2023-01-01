<?php

namespace App\Frontend\VideoChannel\Facade;

use App\Frontend\VideoChannel\Handler\Create\ChannelCreateRequestHandlerFactoryInterface;
use App\Frontend\VideoChannel\Handler\Lookup\ChannelLookupRequestHandlerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoChannelFacade implements VideoChannelFacadeInterface
{
    /**
     * @param ChannelCreateRequestHandlerFactoryInterface $channelCreateRequestHandlerFactory
     * @param ChannelLookupRequestHandlerFactoryInterface $channelLookupRequestHandlerFactory
     */
    public function __construct(
        private readonly ChannelCreateRequestHandlerFactoryInterface $channelCreateRequestHandlerFactory,
        private readonly ChannelLookupRequestHandlerFactoryInterface $channelLookupRequestHandlerFactory
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

    /**
     * {@inheritDoc}
     */
    public function handleLookupChannel(Request $request): VideoChannelTransfer
    {
        return $this->channelLookupRequestHandlerFactory
            ->create()
            ->handleLookupChannel($request);
    }
}
