<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use DateTimeInterface;

final class CategoryGetRequestTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $uuid;
    protected int $flag;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getFlag(): int
    {
        return $this->flag;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function setFlag(int $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'uuid' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'uuid',
          ),
          'flag' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'flag',
          ),
        );
    }
}
