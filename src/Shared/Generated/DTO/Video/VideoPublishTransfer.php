<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use App\Shared\Generated\DTO\File\FileTransfer;
use DateTimeInterface;

final class VideoPublishTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected FileTransfer|null $file = null;

    public function getFile(): FileTransfer|null
    {
        return $this->file;
    }

    public function setFile(FileTransfer|null $file): self
    {
        $this->file = $file;

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
        );
    }
}
