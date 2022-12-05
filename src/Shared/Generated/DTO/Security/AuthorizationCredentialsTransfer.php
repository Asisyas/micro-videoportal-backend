<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Security;

use DateTimeInterface;

final class AuthorizationCredentialsTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected TokenTransfer $token_refresh;
    protected TokenTransfer $token_token_auth;
    protected UserTransfer|null $user = null;

    public function getTokenRefresh(): TokenTransfer
    {
        return $this->token_refresh;
    }

    public function getTokenTokenAuth(): TokenTransfer
    {
        return $this->token_token_auth;
    }

    public function getUser(): UserTransfer|null
    {
        return $this->user;
    }

    public function setTokenRefresh(TokenTransfer $token_refresh): self
    {
        $this->token_refresh = $token_refresh;

        return $this;
    }

    public function setTokenTokenAuth(TokenTransfer $token_token_auth): self
    {
        $this->token_token_auth = $token_token_auth;

        return $this;
    }

    public function setUser(UserTransfer|null $user): self
    {
        $this->user = $user;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'token_refresh' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Security\\TokenTransfer',
            ),
            'required' => true,
            'actionName' => 'tokenRefresh',
          ),
          'token_token_auth' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Security\\TokenTransfer',
            ),
            'required' => true,
            'actionName' => 'tokenTokenAuth',
          ),
          'user' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Security\\UserTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'user',
          ),
        );
    }
}
