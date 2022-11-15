<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class SourceSetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected VideoTransfer|null $video = null;
    protected string|null $src = null;

    public function getVideo(): VideoTransfer|null
    {
        return $this->video;
    }

    public function getSrc(): string|null
    {
        return $this->src;
    }

    public function setVideo(VideoTransfer|null $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function setSrc(string|null $src): self
    {
        $this->src = $src;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'video' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Video\\VideoTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'video',
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
        );
    }
}
