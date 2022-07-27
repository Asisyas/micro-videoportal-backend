<?php

namespace App\Backend\File\Business\Channel\Factory;

use App\Backend\File\Model\ChannelInterface;
use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;
use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;

interface ChannelFactoryInterface
{
    /**
     * @param CredentialsRequestTransfer $requestTransfer
     *
     * @return CredentialsResponseTransfer
     */
    public function create(CredentialsRequestTransfer $requestTransfer): CredentialsResponseTransfer;
}