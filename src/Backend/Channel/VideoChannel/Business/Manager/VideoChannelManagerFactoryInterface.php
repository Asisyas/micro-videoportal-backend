<?php

namespace App\Backend\Channel\VideoChannel\Business\Manager;

interface VideoChannelManagerFactoryInterface
{
    /**
     * @return VideoChannelManagerInterface
     */
    public function create(): VideoChannelManagerInterface;
}
