<?php

namespace App\Backend\File\Business\Channel\Expander\CredentialsResponse;

use App\Backend\File\Business\Channel\Expander\CredentialsResponse\Expander\ExpanderInterface;
use App\Backend\File\Model\ChannelInterface;
use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;

class CredentialsResponseExpander implements CredentialsResponseExpanderInterface
{
    /**
     * @param ChannelInterface $channel
     * @param iterable<ExpanderInterface> $expanderIterator
     */
    public function __construct(
        private readonly ChannelInterface $channel,
        private readonly iterable $expanderIterator
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function expand(CredentialsResponseTransfer $credentialsResponseTransfer): void
    {
        foreach ($this->expanderIterator as $expander) {
            $expander->expand($this->channel, $credentialsResponseTransfer);
        }

        return;
    }
}