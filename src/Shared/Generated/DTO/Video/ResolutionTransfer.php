<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class ResolutionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected int $height;
    protected int $width;
    protected int $fps;

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getFps(): int
    {
        return $this->fps;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function setFps(int $fps): self
    {
        $this->fps = $fps;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'height' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'height',
          ),
          'width' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'width',
          ),
          'fps' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'fps',
          ),
        );
    }
}
