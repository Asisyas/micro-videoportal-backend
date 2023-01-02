<?php

namespace App\Backend\Channel\VideoChannel\Business\Expander\Entity;

interface VideoChannelEntityExpanderFactoryInterface
{
    /**
     * @return VideoChannelEntityExpanderInterface
     */
    public function create(): VideoChannelEntityExpanderInterface;
}
