<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Security;

use DateTimeInterface;

final class AuthConfigurationTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $provider = null;
    protected string $url_auth;

    public function getProvider(): string|null
    {
        return $this->provider;
    }

    public function getUrlAuth(): string
    {
        return $this->url_auth;
    }

    public function setProvider(string|null $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function setUrlAuth(string $url_auth): self
    {
        $this->url_auth = $url_auth;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'provider' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'provider',
          ),
          'url_auth' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'urlAuth',
          ),
        );
    }
}
