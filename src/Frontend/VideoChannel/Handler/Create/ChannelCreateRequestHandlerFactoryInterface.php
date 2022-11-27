<?php

namespace App\Frontend\VideoChannel\Handler\Create;

interface ChannelCreateRequestHandlerFactoryInterface
{
    /**
     * @return ChannelCreateRequestHandlerInterface
     */
    public function create(): ChannelCreateRequestHandlerInterface;
}