<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConverter;

use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Generated\DTO\VideoConfiguration\ResolutionTransfer;
use DateTimeInterface;

final class VideoResolutionConvertRunTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected VideoTransfer $video;
    protected ResolutionTransfer $resolution;

    public function getVideo(): VideoTransfer
    {
        return $this->video;
    }

    public function getResolution(): ResolutionTransfer
    {
        return $this->resolution;
    }

    public function setVideo(VideoTransfer $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function setResolution(ResolutionTransfer $resolution): self
    {
        $this->resolution = $resolution;

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
            ),
            'required' => true,
            'actionName' => 'video',
          ),
          'resolution' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\VideoConfiguration\\ResolutionTransfer',
            ),
            'required' => true,
            'actionName' => 'resolution',
          ),
        );
    }
}
