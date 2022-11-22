<?php

namespace App\Backend\VideoChannel\Business\Manager;

interface VideoChannelManagerFactoryInterface
{
    /**
     * @return VideoChannelManagerInterface
     */
    public function create(): VideoChannelManagerInterface;
}