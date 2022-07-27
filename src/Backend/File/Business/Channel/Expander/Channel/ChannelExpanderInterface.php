<?php

namespace App\Backend\File\Business\Channel\Expander\Channel;

use App\Backend\File\Model\ChannelInterface;

interface ChannelExpanderInterface
{
    /**
     * @param ChannelInterface $channel
     *
     * @return void
     */
    public function expand(ChannelInterface $channel): void;
}