<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoDescriptionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $video_id;
    protected string $title;
    protected string|null $description = null;

    public function getVideoId(): string
    {
        return $this->video_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function setVideoId(string $video_id): self
    {
        $this->video_id = $video_id;

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
          'video_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'videoId',
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
