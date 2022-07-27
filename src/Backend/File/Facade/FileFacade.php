<?php

namespace App\Backend\File\Facade;

use App\Backend\File\Business\Channel\Factory\ChannelFactoryInterface;
use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;
use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;

class FileFacade implements FileFacadeInterface
{
    public function __construct(private readonly ChannelFactoryInterface $channelFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createChannel(CredentialsRequestTransfer $credentialsRequestTransfer): CredentialsResponseTransfer
    {
        return $this->channelFactory->create($credentialsRequestTransfer);
    }

    public function getChannel()
    {
        // TODO: Implement getChannel() method.
    }
}