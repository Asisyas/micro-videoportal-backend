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
    protected int|null $bitRateMin = null;
    protected int|null $bitRateMax = null;
    protected int|null $frameRate = null;
    protected bool|null $media_type_flag = null;

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getBitRateMin(): int|null
    {
        return $this->bitRateMin;
    }

    public function getBitRateMax(): int|null
    {
        return $this->bitRateMax;
    }

    public function getFrameRate(): int|null
    {
        return $this->frameRate;
    }

    public function getMediaTypeFlag(): bool|null
    {
        return $this->media_type_flag;
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

    public function setBitRateMin(int|null $bitRateMin): self
    {
        $this->bitRateMin = $bitRateMin;

        return $this;
    }

    public function setBitRateMax(int|null $bitRateMax): self
    {
        $this->bitRateMax = $bitRateMax;

        return $this;
    }

    public function setFrameRate(int|null $frameRate): self
    {
        $this->frameRate = $frameRate;

        return $this;
    }

    public function setMediaTypeFlag(bool|null $media_type_flag): self
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
          'bitRateMin' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'bitRateMin',
          ),
          'bitRateMax' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'bitRateMax',
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
          'media_type_flag' =>
          array (
            'type' =>
            array (
              0 => 'bool',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'mediaTypeFlag',
          ),
        );
    }
}
