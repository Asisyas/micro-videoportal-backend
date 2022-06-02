<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\ClientReader;

use DateTimeInterface;

final class ResponseTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $uuid;
    protected string $index;
    protected array $data;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getIndex(): string
    {
        return $this->index;
    }

    public function getData(): array
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

    public function setData(array $data): self
    {
        $this->data = $data;

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
          'index' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'index',
          ),
          'data' =>
          array (
            'type' =>
            array (
              0 => 'array',
            ),
            'required' => true,
            'actionName' => 'data',
          ),
        );
    }
}
