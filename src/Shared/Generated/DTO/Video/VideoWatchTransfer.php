<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoWatchTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $channel_id = null;
    protected VideoChannelTransfer|null $channel = null;
    protected string $id;
    protected string|null $src = null;
    protected DateTimeInterface|null $created_at = null;
    protected string $title;
    protected string|null $description = null;

    public function getChannelId(): string|null
    {
        return $this->channel_id;
    }

    public function getChannel(): VideoChannelTransfer|null
    {
        return $this->channel;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function setChannelId(string|null $channel_id): self
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function setChannel(VideoChannelTransfer|null $channel): self
    {
        $this->channel = $channel;

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

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setDescription(string|null $description): self
    {
        $this->description = $description;

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
          'channel' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Video\\VideoChannelTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'channel',
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
          'title' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
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
        );
    }
}
