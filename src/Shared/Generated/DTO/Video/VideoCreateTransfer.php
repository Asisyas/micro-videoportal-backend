<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoCreateTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $channel_id = null;
    protected string $video_id;

    public function getChannelId(): string|null
    {
        return $this->channel_id;
    }

    public function getVideoId(): string
    {
        return $this->video_id;
    }

    public function setChannelId(string|null $channel_id): self
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function setVideoId(string $video_id): self
    {
        $this->video_id = $video_id;

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
          'video_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'videoId',
          ),
        );
    }
}
