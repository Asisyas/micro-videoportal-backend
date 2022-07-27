<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class CredentialsResponseTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $id;
    protected int $chunk_size;
    protected int $chunk_count;
    protected int $size;

    public function getId(): string
    {
        return $this->id;
    }

    public function getChunkSize(): int
    {
        return $this->chunk_size;
    }

    public function getChunkCount(): int
    {
        return $this->chunk_count;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setChunkSize(int $chunk_size): self
    {
        $this->chunk_size = $chunk_size;

        return $this;
    }

    public function setChunkCount(int $chunk_count): self
    {
        $this->chunk_count = $chunk_count;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'id',
          ),
          'chunk_size' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'chunkSize',
          ),
          'chunk_count' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'chunkCount',
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
        );
    }
}
