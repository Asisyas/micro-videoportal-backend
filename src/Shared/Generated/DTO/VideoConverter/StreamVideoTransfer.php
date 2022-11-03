<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConverter;

use DateTimeInterface;

final class StreamVideoTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $codec = null;
    protected int|null $height = null;
    protected int|null $width = null;
    protected int|null $bitRate = null;
    protected int|null $frameRate = null;
    protected float|null $duration = null;

    public function getCodec(): string|null
    {
        return $this->codec;
    }

    public function getHeight(): int|null
    {
        return $this->height;
    }

    public function getWidth(): int|null
    {
        return $this->width;
    }

    public function getBitRate(): int|null
    {
        return $this->bitRate;
    }

    public function getFrameRate(): int|null
    {
        return $this->frameRate;
    }

    public function getDuration(): float|null
    {
        return $this->duration;
    }

    public function setCodec(string|null $codec): self
    {
        $this->codec = $codec;

        return $this;
    }

    public function setHeight(int|null $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function setWidth(int|null $width): self
    {
        $this->width = $width;

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

    public function setDuration(float|null $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'codec' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'codec',
          ),
          'height' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'height',
          ),
          'width' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'width',
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
          'duration' =>
          array (
            'type' =>
            array (
              0 => 'float',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'duration',
          ),
        );
    }
}
