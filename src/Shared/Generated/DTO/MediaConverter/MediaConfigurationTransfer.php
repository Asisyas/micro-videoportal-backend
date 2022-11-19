<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use DateTimeInterface;

final class MediaConfigurationTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected FileTransfer|null $file = null;
    protected VideoTransfer|null $video = null;
    protected MediaResolutionTransfer|null $resolution_configuration = null;

    public function getFile(): FileTransfer|null
    {
        return $this->file;
    }

    public function getVideo(): VideoTransfer|null
    {
        return $this->video;
    }

    public function getResolutionConfiguration(): MediaResolutionTransfer|null
    {
        return $this->resolution_configuration;
    }

    public function setFile(FileTransfer|null $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setVideo(VideoTransfer|null $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function setResolutionConfiguration(MediaResolutionTransfer|null $resolution_configuration): self
    {
        $this->resolution_configuration = $resolution_configuration;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'file' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\File\\FileTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'file',
          ),
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
          'resolution_configuration' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\MediaConverter\\MediaResolutionTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'resolutionConfiguration',
          ),
        );
    }
}
