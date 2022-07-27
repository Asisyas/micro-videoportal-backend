<?php

namespace App\Backend\File\Business\Channel\Expander\CredentialsResponse;

use App\Backend\File\Model\ChannelInterface;

class CredentialsResponseExpanderFactory implements CredentialsResponseExpanderFactoryInterface
{
    /**
     * @param iterable $expanderIterable
     */
    public function __construct(private readonly iterable $expanderIterable)
    {
    }

    /**
     * @param ChannelInterface $channelEntity
     *
     * @return CredentialsResponseExpanderInterface
     */
    public function create(ChannelInterface $channelEntity): CredentialsResponseExpanderInterface
    {
        return new CredentialsResponseExpander($channelEntity, $this->expanderIterable);
    }
}