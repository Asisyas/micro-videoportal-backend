<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class FileMetadataTransferTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $content_type = null;
    protected int|null $length = null;
    protected string|null $extension = null;

    public function getContentType(): string|null
    {
        return $this->content_type;
    }

    public function getLength(): int|null
    {
        return $this->length;
    }

    public function getExtension(): string|null
    {
        return $this->extension;
    }

    public function setContentType(string|null $content_type): self
    {
        $this->content_type = $content_type;

        return $this;
    }

    public function setLength(int|null $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function setExtension(string|null $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'content_type' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'contentType',
          ),
          'length' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'length',
          ),
          'extension' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'extension',
          ),
        );
    }
}
