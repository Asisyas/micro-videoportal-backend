<?php

namespace App\Client\File;


use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;


interface FileClientInterface
{
    /**
     * @param CredentialsRequestTransfer $fileCredentialsTransfer
     *
     * @return ResponseTransfer
     */
    public function createChannel(CredentialsRequestTransfer $fileCredentialsTransfer): ResponseTransfer;
}