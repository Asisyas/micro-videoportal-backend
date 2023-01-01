<?php

namespace App\Frontend\VideoChannel\Handler\Create;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;

class ChannelCreateRequestHandlerFactory implements ChannelCreateRequestHandlerFactoryInterface
{
    /**
     * @param ClientVideoChannelInterface $videoChannelClient
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly ClientVideoChannelInterface $videoChannelClient,
        private readonly SecurityFacadeInterface     $securityFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ChannelCreateRequestHandlerInterface
    {
        return new ChannelCreateRequestHandler(
            $this->videoChannelClient,
            $this->securityFacade,
        );
    }
}
