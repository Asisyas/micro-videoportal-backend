<?php

namespace App\Backend\File\Business\Channel\Expander\Channel;

use App\Backend\File\Model\ChannelInterface;

interface ChannelExpanderFactoryInterface
{
    /**
     * @param ChannelInterface $channel
     *
     * @return ChannelExpanderInterface
     */
    public function create(ChannelInterface $channel): ChannelExpanderInterface;
}