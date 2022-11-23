<?php

namespace App\Frontend\VideoChannel\Handler\Create;

use App\Client\VideoChannel\Client\VideoChannelClientInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;

class ChannelCreateRequestHandlerFactory implements ChannelCreateRequestHandlerFactoryInterface
{
    /**
     * @param VideoChannelClientInterface $videoChannelClient
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly VideoChannelClientInterface $videoChannelClient,
        private readonly SecurityFacadeInterface $securityFacade
    )
    {
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