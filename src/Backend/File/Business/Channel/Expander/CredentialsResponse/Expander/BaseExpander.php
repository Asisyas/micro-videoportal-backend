<?php

namespace App\Backend\File\Business\Channel\Expander\CredentialsResponse\Expander;

use App\Backend\File\Model\ChannelInterface;
use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;

class BaseExpander implements ExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(ChannelInterface $channel, CredentialsResponseTransfer $credentialsResponseTransfer): void
    {
        $credentialsResponseTransfer->setId($channel->getUuid());
        $credentialsResponseTransfer->setChunkSize($channel->getChunkSize());
        $credentialsResponseTransfer->setChunkCount($channel->getChunkCount());
        $credentialsResponseTransfer->setSize($channel->getSize());
    }
}