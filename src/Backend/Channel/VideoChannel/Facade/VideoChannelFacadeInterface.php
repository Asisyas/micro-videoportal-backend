<?php

namespace App\Backend\Channel\VideoChannel\Facade;

use App\Backend\Channel\VideoChannel\Business\Manager\VideoChannelManagerInterface;
use App\Backend\Channel\VideoChannel\Business\Publisher\PublisherInterface;

interface VideoChannelFacadeInterface extends VideoChannelManagerInterface, PublisherInterface
{
}
