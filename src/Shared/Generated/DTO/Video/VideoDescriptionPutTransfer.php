<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoDescriptionPutTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $video_id;
    protected VideoDescriptionTransfer|null $source = null;

    public function getVideoId(): string
    {
        return $this->video_id;
    }

    public function getSource(): VideoDescriptionTransfer|null
    {
        return $this->source;
    }

    public function setVideoId(string $video_id): self
    {
        $this->video_id = $video_id;

        return $this;
    }

    public function setSource(VideoDescriptionTransfer|null $source): self
    {
        $this->source = $source;

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
          'source' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Video\\VideoDescriptionTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'source',
          ),
        );
    }
}
