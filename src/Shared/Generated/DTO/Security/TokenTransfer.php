<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Security;

use DateTimeInterface;

final class TokenTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $token = null;
    protected int|null $time_now = null;
    protected int|null $expires_at_access = null;
    protected int|null $expires_at_refresh = null;
    protected TokenOwnerTransfer|null $user = null;

    public function getToken(): string|null
    {
        return $this->token;
    }

    public function getTimeNow(): int|null
    {
        return $this->time_now;
    }

    public function getExpiresAtAccess(): int|null
    {
        return $this->expires_at_access;
    }

    public function getExpiresAtRefresh(): int|null
    {
        return $this->expires_at_refresh;
    }

    public function getUser(): TokenOwnerTransfer|null
    {
        return $this->user;
    }

    public function setToken(string|null $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function setTimeNow(int|null $time_now): self
    {
        $this->time_now = $time_now;

        return $this;
    }

    public function setExpiresAtAccess(int|null $expires_at_access): self
    {
        $this->expires_at_access = $expires_at_access;

        return $this;
    }

    public function setExpiresAtRefresh(int|null $expires_at_refresh): self
    {
        $this->expires_at_refresh = $expires_at_refresh;

        return $this;
    }

    public function setUser(TokenOwnerTransfer|null $user): self
    {
        $this->user = $user;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'token' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'token',
          ),
          'time_now' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'timeNow',
          ),
          'expires_at_access' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'expiresAtAccess',
          ),
          'expires_at_refresh' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'expiresAtRefresh',
          ),
          'user' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Security\\TokenOwnerTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'user',
          ),
        );
    }
}
