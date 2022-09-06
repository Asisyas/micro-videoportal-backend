<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class ChunkTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $file_id;
    protected int $size;
    protected int $offset;
    protected string $blob;

    public function getFileId(): string
    {
        return $this->file_id;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getBlob(): string
    {
        return $this->blob;
    }

    public function setFileId(string $file_id): self
    {
        $this->file_id = $file_id;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function setBlob(string $blob): self
    {
        $this->blob = $blob;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'file_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'fileId',
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
          'offset' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'offset',
          ),
          'blob' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'blob',
          ),
        );
    }
}