<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConverter;

use DateTimeInterface;

final class ResolutionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected int $height;
    protected int $width;
    protected int $fps;
    protected int|null $bitRate = null;
    protected int|null $frameRate = null;

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

    public function getBitRate(): int|null
    {
        return $this->bitRate;
    }

    public function getFrameRate(): int|null
    {
        return $this->frameRate;
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

    public function setBitRate(int|null $bitRate): self
    {
        $this->bitRate = $bitRate;

        return $this;
    }

    public function setFrameRate(int|null $frameRate): self
    {
        $this->frameRate = $frameRate;

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
          'bitRate' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'bitRate',
          ),
          'frameRate' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'frameRate',
          ),
        );
    }
}
