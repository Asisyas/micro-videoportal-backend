<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $channel_id = null;
    protected string $id;
    protected string|null $src = null;
    protected DateTimeInterface|null $created_at = null;

    public function getChannelId(): string|null
    {
        return $this->channel_id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSrc(): string|null
    {
        return $this->src;
    }

    public function getCreatedAt(): DateTimeInterface|null
    {
        return $this->created_at;
    }

    public function setChannelId(string|null $channel_id): self
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setSrc(string|null $src): self
    {
        $this->src = $src;

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
          'channel_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'channelId',
          ),
          'id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'id',
          ),
          'src' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'src',
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
