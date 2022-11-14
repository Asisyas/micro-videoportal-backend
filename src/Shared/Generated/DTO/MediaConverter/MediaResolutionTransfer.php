<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use DateTimeInterface;

final class MediaResolutionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected int|null $height = null;
    protected int|null $width = null;
    protected int|null $fps = null;
    protected int|null $bit_rate = null;
    protected int|null $frame_rate = null;
    protected int|null $keyint_min = null;
    protected int|null $gop = null;
    protected int|null $media_type_flag = null;

    public function getHeight(): int|null
    {
        return $this->height;
    }

    public function getWidth(): int|null
    {
        return $this->width;
    }

    public function getFps(): int|null
    {
        return $this->fps;
    }

    public function getBitRate(): int|null
    {
        return $this->bit_rate;
    }

    public function getFrameRate(): int|null
    {
        return $this->frame_rate;
    }

    public function getKeyintMin(): int|null
    {
        return $this->keyint_min;
    }

    public function getGop(): int|null
    {
        return $this->gop;
    }

    public function getMediaTypeFlag(): int|null
    {
        return $this->media_type_flag;
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

    public function setFps(int|null $fps): self
    {
        $this->fps = $fps;

        return $this;
    }

    public function setBitRate(int|null $bit_rate): self
    {
        $this->bit_rate = $bit_rate;

        return $this;
    }

    public function setFrameRate(int|null $frame_rate): self
    {
        $this->frame_rate = $frame_rate;

        return $this;
    }

    public function setKeyintMin(int|null $keyint_min): self
    {
        $this->keyint_min = $keyint_min;

        return $this;
    }

    public function setGop(int|null $gop): self
    {
        $this->gop = $gop;

        return $this;
    }

    public function setMediaTypeFlag(int|null $media_type_flag): self
    {
        $this->media_type_flag = $media_type_flag;

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
          'fps' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'fps',
          ),
          'bit_rate' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'bitRate',
          ),
          'frame_rate' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'frameRate',
          ),
          'keyint_min' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'keyintMin',
          ),
          'gop' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'gop',
          ),
          'media_type_flag' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'mediaTypeFlag',
          ),
        );
    }
}
