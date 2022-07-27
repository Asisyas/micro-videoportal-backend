<?php

namespace App\Backend\File\Business\Channel\Expander\CredentialsResponse;

use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;

interface CredentialsResponseExpanderInterface
{
    /**
     * @param CredentialsResponseTransfer $credentialsResponseTransfer
     *
     * @return void
     */
    public function expand(CredentialsResponseTransfer $credentialsResponseTransfer): void;
}