<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoChannelGetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $channel_id = null;
    protected string|null $owner_id = null;

    public function getChannelId(): string|null
    {
        return $this->channel_id;
    }

    public function getOwnerId(): string|null
    {
        return $this->owner_id;
    }

    public function setChannelId(string|null $channel_id): self
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function setOwnerId(string|null $owner_id): self
    {
        $this->owner_id = $owner_id;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'channel_id' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'channelId',
          ),
          'owner_id' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'ownerId',
          ),
        );
    }
}
