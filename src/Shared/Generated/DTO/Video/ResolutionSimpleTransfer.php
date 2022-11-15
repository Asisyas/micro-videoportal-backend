<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class ResolutionSimpleTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $file = null;
    protected string|null $resolution = null;

    public function getFile(): string|null
    {
        return $this->file;
    }

    public function getResolution(): string|null
    {
        return $this->resolution;
    }

    public function setFile(string|null $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setResolution(string|null $resolution): self
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
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'file',
          ),
          'resolution' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'resolution',
          ),
        );
    }
}
