<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class FileCredentialsTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $name;
    protected string $crc32;
    protected int $size;
    protected string $type;

    public function getName(): string
    {
        return $this->name;
    }

    public function getCrc32(): string
    {
        return $this->crc32;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setCrc32(string $crc32): self
    {
        $this->crc32 = $crc32;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'name' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'name',
          ),
          'crc32' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'crc32',
          ),
          'size' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'size',
          ),
          'type' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'type',
          ),
        );
    }
}
