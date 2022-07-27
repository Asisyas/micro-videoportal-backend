<?php

namespace App\Backend\File\Business\Channel\Expander\CredentialsResponse\Expander;

use App\Backend\File\Model\ChannelInterface;
use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;

interface ExpanderInterface
{
    /**
     * @param ChannelInterface $channel
     * @param CredentialsResponseTransfer $credentialsResponseTransfer
     *
     * @return void
     */
    public function expand(ChannelInterface $channel, CredentialsResponseTransfer $credentialsResponseTransfer): void;
}