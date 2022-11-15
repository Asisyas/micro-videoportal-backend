<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class FileUploadTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $name;
    protected int $size;
    protected string $content_type;

    /** Source stream address */
    protected string $source;

    public function getName(): string
    {
        return $this->name;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getContentType(): string
    {
        return $this->content_type;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setContentType(string $content_type): self
    {
        $this->content_type = $content_type;

        return $this;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

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
          'size' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'size',
          ),
          'content_type' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'contentType',
          ),
          'source' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'source',
          ),
        );
    }
}
