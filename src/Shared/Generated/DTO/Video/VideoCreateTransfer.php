<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoCreateTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $file_id;

    public function getFileId(): string
    {
        return $this->file_id;
    }

    public function setFileId(string $file_id): self
    {
        $this->file_id = $file_id;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'file_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'fileId',
          ),
        );
    }
}
