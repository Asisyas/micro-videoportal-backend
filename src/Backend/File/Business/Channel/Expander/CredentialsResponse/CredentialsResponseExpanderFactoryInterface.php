<?php

namespace App\Backend\File\Business\Channel\Expander\CredentialsResponse;

use App\Backend\File\Model\ChannelInterface;

interface CredentialsResponseExpanderFactoryInterface
{
    /**
     * @param ChannelInterface $channelEntity
     *
     * @return CredentialsResponseExpanderInterface
     */
    public function create(ChannelInterface $channelEntity): CredentialsResponseExpanderInterface;
}