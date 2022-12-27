<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use DateTimeInterface;

final class MediaConvertedResultTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $src;
    protected MediaResolutionTransfer $resolution;

    public function getSrc(): string
    {
        return $this->src;
    }

    public function getResolution(): MediaResolutionTransfer
    {
        return $this->resolution;
    }

    public function setSrc(string $src): self
    {
        $this->src = $src;

        return $this;
    }

    public function setResolution(MediaResolutionTransfer $resolution): self
    {
        $this->resolution = $resolution;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'src' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'src',
          ),
          'resolution' =>
          array(
            'type' =>
            array(
              0 => 'App\\Shared\\Generated\\DTO\\MediaConverter\\MediaResolutionTransfer',
            ),
            'required' => true,
            'actionName' => 'resolution',
          ),
        );
    }
}
