<?php

namespace App\Frontend\VideoChannel\Handler;

interface ChannelCreateRequestHandlerFactoryInterface
{
    /**
     * @return ChannelCreateRequestHandlerInterface
     */
    public function create(): ChannelCreateRequestHandlerInterface;
}