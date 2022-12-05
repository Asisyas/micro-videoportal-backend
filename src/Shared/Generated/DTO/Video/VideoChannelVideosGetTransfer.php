<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoChannelVideosGetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $channel_id = null;
    protected int|null $limit = null;
    protected int|null $offset = null;

    public function getChannelId(): string|null
    {
        return $this->channel_id;
    }

    public function getLimit(): int|null
    {
        return $this->limit;
    }

    public function getOffset(): int|null
    {
        return $this->offset;
    }

    public function setChannelId(string|null $channel_id): self
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function setLimit(int|null $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function setOffset(int|null $offset): self
    {
        $this->offset = $offset;

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
          'limit' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'limit',
          ),
          'offset' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'offset',
          ),
        );
    }
}
