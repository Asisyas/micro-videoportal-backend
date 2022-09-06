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
    protected \number $size;
    protected \number $offset;
    protected string $blob;

    public function getFileId(): string
    {
        return $this->file_id;
    }

    public function getSize(): \number
    {
        return $this->size;
    }

    public function getOffset(): \number
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

    public function setSize(\number $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setOffset(\number $offset): self
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
              0 => 'number',
            ),
            'required' => true,
            'actionName' => 'size',
          ),
          'offset' =>
          array (
            'type' =>
            array (
              0 => 'number',
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
