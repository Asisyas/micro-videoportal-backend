<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoChannelCreateTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $id;
    protected string $owner_id;
    protected string|null $title = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwnerId(): string
    {
        return $this->owner_id;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setOwnerId(string $owner_id): self
    {
        $this->owner_id = $owner_id;

        return $this;
    }

    public function setTitle(string|null $title): self
    {
        $this->title = $title;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'id' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'id',
          ),
          'owner_id' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'ownerId',
          ),
          'title' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'title',
          ),
        );
    }
}
