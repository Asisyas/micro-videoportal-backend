<?php

namespace App\Backend\VideoChannel\Facade;

use App\Backend\VideoChannel\Business\Manager\VideoChannelManagerInterface;
use App\Backend\VideoChannel\Business\Publisher\PublisherInterface;

interface VideoChannelFacadeInterface extends VideoChannelManagerInterface, PublisherInterface
{
}