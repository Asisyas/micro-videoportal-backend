<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use App\Shared\Generated\DTO\File\FileTransfer;
use DateTimeInterface;

final class MediaConfigurationTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected FileTransfer|null $file = null;
    protected MediaResolutionTransfer|null $resolution_configuration = null;
    protected bool|null $is_disable_video = null;
    protected bool|null $is_disable_audio = null;

    public function getFile(): FileTransfer|null
    {
        return $this->file;
    }

    public function getResolutionConfiguration(): MediaResolutionTransfer|null
    {
        return $this->resolution_configuration;
    }

    public function getIsDisableVideo(): bool|null
    {
        return $this->is_disable_video;
    }

    public function getIsDisableAudio(): bool|null
    {
        return $this->is_disable_audio;
    }

    public function setFile(FileTransfer|null $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setResolutionConfiguration(MediaResolutionTransfer|null $resolution_configuration): self
    {
        $this->resolution_configuration = $resolution_configuration;

        return $this;
    }

    public function setIsDisableVideo(bool|null $is_disable_video): self
    {
        $this->is_disable_video = $is_disable_video;

        return $this;
    }

    public function setIsDisableAudio(bool|null $is_disable_audio): self
    {
        $this->is_disable_audio = $is_disable_audio;

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
          'is_disable_video' =>
          array (
            'type' =>
            array (
              0 => 'bool',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'isDisableVideo',
          ),
          'is_disable_audio' =>
          array (
            'type' =>
            array (
              0 => 'bool',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'isDisableAudio',
          ),
        );
    }
}
