<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoIndexTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $id = null;
    protected string|null $title = null;
    protected string|null $description = null;
    protected array|null $resolutions = null;
    protected DateTimeInterface|null $created_at = null;

    public function getId(): string|null
    {
        return $this->id;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function getResolutions(): array|null
    {
        return $this->resolutions;
    }

    public function getCreatedAt(): DateTimeInterface|null
    {
        return $this->created_at;
    }

    public function setId(string|null $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setTitle(string|null $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setDescription(string|null $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setResolutions(array|null $resolutions): self
    {
        $this->resolutions = $resolutions;

        return $this;
    }

    public function setCreatedAt(DateTimeInterface|null $created_at): self
    {
        $this->created_at = $created_at;

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
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'id',
          ),
          'title' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'title',
          ),
          'description' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'description',
          ),
          'resolutions' =>
          array (
            'type' =>
            array (
              0 => 'array',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'resolutions',
          ),
          'created_at' =>
          array (
            'type' =>
            array (
              0 => 'DateTimeInterface',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'createdAt',
          ),
        );
    }
}
