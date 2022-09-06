<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class ChunkResponseTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $file_id;
    protected int $size_remaining;
    protected int $size_loaded;

    public function getFileId(): string
    {
        return $this->file_id;
    }

    public function getSizeRemaining(): int
    {
        return $this->size_remaining;
    }

    public function getSizeLoaded(): int
    {
        return $this->size_loaded;
    }

    public function setFileId(string $file_id): self
    {
        $this->file_id = $file_id;

        return $this;
    }

    public function setSizeRemaining(int $size_remaining): self
    {
        $this->size_remaining = $size_remaining;

        return $this;
    }

    public function setSizeLoaded(int $size_loaded): self
    {
        $this->size_loaded = $size_loaded;

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
          'size_remaining' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'sizeRemaining',
          ),
          'size_loaded' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'sizeLoaded',
          ),
        );
    }
}
