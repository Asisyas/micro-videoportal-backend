<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoDescriptionGetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $video_id;

    public function getVideoId(): string
    {
        return $this->video_id;
    }

    public function setVideoId(string $video_id): self
    {
        $this->video_id = $video_id;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'video_id' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'videoId',
          ),
        );
    }
}
