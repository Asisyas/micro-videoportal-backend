<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConverter;

use DateTimeInterface;

final class VideoConvertResultTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $path;
    protected ResolutionTransfer $resolution;

    public function getPath(): string
    {
        return $this->path;
    }

    public function getResolution(): ResolutionTransfer
    {
        return $this->resolution;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

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
          'path' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'path',
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
