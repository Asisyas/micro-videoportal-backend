<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConverter;

use App\Shared\Generated\DTO\File\FileTransfer;
use DateTimeInterface;

final class VideoConvertTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected FileTransfer $file;
    protected VideoMetadataTransfer|null $meta = null;
    protected ResolutionTransfer $resolution;

    public function getFile(): FileTransfer
    {
        return $this->file;
    }

    public function getMeta(): VideoMetadataTransfer|null
    {
        return $this->meta;
    }

    public function getResolution(): ResolutionTransfer
    {
        return $this->resolution;
    }

    public function setFile(FileTransfer $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setMeta(VideoMetadataTransfer|null $meta): self
    {
        $this->meta = $meta;

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
          'file' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\File\\FileTransfer',
            ),
            'required' => true,
            'actionName' => 'file',
          ),
          'meta' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\VideoConverter\\VideoMetadataTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'meta',
          ),
          'resolution' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\VideoConverter\\ResolutionTransfer',
            ),
            'required' => true,
            'actionName' => 'resolution',
          ),
        );
    }
}
