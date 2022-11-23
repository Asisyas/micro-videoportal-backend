<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoPublishTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $channel_id;
    protected string|null $file_id = null;

    public function getChannelId(): string
    {
        return $this->channel_id;
    }

    public function getFileId(): string|null
    {
        return $this->file_id;
    }

    public function setChannelId(string $channel_id): self
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function setFileId(string|null $file_id): self
    {
        $this->file_id = $file_id;

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
            ),
            'required' => true,
            'actionName' => 'channelId',
          ),
          'file_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'fileId',
          ),
        );
    }
}
