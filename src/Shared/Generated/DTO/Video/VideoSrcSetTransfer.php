<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoSrcSetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $video_id;
    protected string $src;

    public function getVideoId(): string
    {
        return $this->video_id;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function setVideoId(string $video_id): self
    {
        $this->video_id = $video_id;

        return $this;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'video_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'videoId',
          ),
          'src' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'src',
          ),
        );
    }
}
