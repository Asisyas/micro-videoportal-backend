<?php

namespace App\Frontend\VideoChannel\Facade;

use App\Frontend\VideoChannel\Handler\Create\ChannelCreateRequestHandlerInterface;
use App\Frontend\VideoChannel\Handler\Lookup\ChannelLookupRequestHandlerInterface;

interface VideoChannelFacadeInterface extends ChannelCreateRequestHandlerInterface, ChannelLookupRequestHandlerInterface
{
}
