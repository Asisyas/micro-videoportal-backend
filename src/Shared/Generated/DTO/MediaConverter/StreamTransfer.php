<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use DateTimeInterface;

final class StreamTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $codec = null;
    protected int|null $rate = null;
    protected int|null $channel_count = null;
    protected string|null $channel_layout = null;
    protected int|null $height = null;
    protected int|null $width = null;
    protected int|null $bitRate = null;
    protected int|null $frame_rate = null;
    protected float|null $duration = null;
    protected int|null $media_type_flag = null;

    public function getCodec(): string|null
    {
        return $this->codec;
    }

    public function getRate(): int|null
    {
        return $this->rate;
    }

    public function getChannelCount(): int|null
    {
        return $this->channel_count;
    }

    public function getChannelLayout(): string|null
    {
        return $this->channel_layout;
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
        return $this->frame_rate;
    }

    public function getDuration(): float|null
    {
        return $this->duration;
    }

    public function getMediaTypeFlag(): int|null
    {
        return $this->media_type_flag;
    }

    public function setCodec(string|null $codec): self
    {
        $this->codec = $codec;

        return $this;
    }

    public function setRate(int|null $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function setChannelCount(int|null $channel_count): self
    {
        $this->channel_count = $channel_count;

        return $this;
    }

    public function setChannelLayout(string|null $channel_layout): self
    {
        $this->channel_layout = $channel_layout;

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

    public function setFrameRate(int|null $frame_rate): self
    {
        $this->frame_rate = $frame_rate;

        return $this;
    }

    public function setDuration(float|null $duration): self
    {
        $this->duration = $duration;

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
          'rate' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'rate',
          ),
          'channel_count' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'channelCount',
          ),
          'channel_layout' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'channelLayout',
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
