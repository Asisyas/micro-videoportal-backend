<?php

namespace App\Backend\File\Facade;

use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;
use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;

interface FileFacadeInterface
{
    /**
     * @param CredentialsRequestTransfer $credentialsRequestTransfer
     *
     * @return CredentialsResponseTransfer
     */
    public function createChannel(CredentialsRequestTransfer $credentialsRequestTransfer): CredentialsResponseTransfer;

    /**
     * @return mixed
     */
    public function getChannel();
}