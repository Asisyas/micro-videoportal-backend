<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Security;

use DateTimeInterface;

final class AuthCodeRequestTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $code = null;
    protected string|null $provider = null;

    public function getCode(): string|null
    {
        return $this->code;
    }

    public function getProvider(): string|null
    {
        return $this->provider;
    }

    public function setCode(string|null $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setProvider(string|null $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'code' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'code',
          ),
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
        );
    }
}
