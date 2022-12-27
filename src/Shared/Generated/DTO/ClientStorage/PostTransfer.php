<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\ClientStorage;

use DateTimeInterface;
use Micro\Library\DTO\Object\AbstractDto;

final class PostTransfer extends AbstractDto
{
    protected string $uuid;
    protected string $index;
    protected AbstractDto|array|string|int|float|bool $data;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getIndex(): string
    {
        return $this->index;
    }

    public function getData(): AbstractDto|array|string|int|float|bool
    {
        return $this->data;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function setIndex(string $index): self
    {
        $this->index = $index;

        return $this;
    }

    public function setData(AbstractDto|array|string|int|float|bool $data): self
    {
        $this->data = $data;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'uuid' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'uuid',
          ),
          'index' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'index',
          ),
          'data' =>
          array(
            'type' =>
            array(
              0 => 'Micro\\Library\\DTO\\Object\\AbstractDto',
              1 => 'array',
              2 => 'string',
              3 => 'int',
              4 => 'float',
              5 => 'bool',
            ),
            'required' => true,
            'actionName' => 'data',
          ),
        );
    }
}
