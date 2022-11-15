<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $id;
    protected string $name;
    protected DateTimeInterface $created_at;
    protected SourceTransfer|null $media = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->created_at;
    }

    public function getMedia(): SourceTransfer|null
    {
        return $this->media;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function setMedia(SourceTransfer|null $media): self
    {
        $this->media = $media;

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
          'name' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'name',
          ),
          'created_at' =>
          array (
            'type' =>
            array (
              0 => 'DateTimeInterface',
            ),
            'required' => true,
            'actionName' => 'createdAt',
          ),
          'media' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Video\\SourceTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'media',
          ),
        );
    }
}
