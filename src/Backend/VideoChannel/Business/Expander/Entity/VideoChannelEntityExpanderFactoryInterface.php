<?php

namespace App\Backend\VideoChannel\Business\Expander\Entity;

interface VideoChannelEntityExpanderFactoryInterface
{
    /**
     * @return VideoChannelEntityExpanderInterface
     */
    public function create(): VideoChannelEntityExpanderInterface;
}
