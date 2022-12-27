<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use App\Shared\Generated\DTO\File\FileTransfer;
use DateTimeInterface;

final class VideoConvertTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected FileTransfer $file;
    protected \MediaConverter\VideoMetadata|null $meta = null;
    protected \MediaConverter\Resolution $resolution;

    public function getFile(): FileTransfer
    {
        return $this->file;
    }

    public function getMeta(): \MediaConverter\VideoMetadata|null
    {
        return $this->meta;
    }

    public function getResolution(): \MediaConverter\Resolution
    {
        return $this->resolution;
    }

    public function setFile(FileTransfer $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setMeta(\MediaConverter\VideoMetadata|null $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    public function setResolution(\MediaConverter\Resolution $resolution): self
    {
        $this->resolution = $resolution;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'file' =>
          array(
            'type' =>
            array(
              0 => 'App\\Shared\\Generated\\DTO\\File\\FileTransfer',
            ),
            'required' => true,
            'actionName' => 'file',
          ),
          'meta' =>
          array(
            'type' =>
            array(
              0 => 'MediaConverter\\VideoMetadata',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'meta',
          ),
          'resolution' =>
          array(
            'type' =>
            array(
              0 => 'MediaConverter\\Resolution',
            ),
            'required' => true,
            'actionName' => 'resolution',
          ),
        );
    }
}
