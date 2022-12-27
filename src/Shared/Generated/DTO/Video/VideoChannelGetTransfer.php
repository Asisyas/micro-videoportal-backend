<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoChannelGetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $channel_id;

    public function getChannelId(): string
    {
        return $this->channel_id;
    }

    public function setChannelId(string $channel_id): self
    {
        $this->channel_id = $channel_id;

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
            ),
            'required' => true,
            'actionName' => 'channelId',
          ),
        );
    }
}
