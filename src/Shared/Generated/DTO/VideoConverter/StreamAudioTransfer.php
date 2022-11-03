<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConverter;

use DateTimeInterface;

final class StreamAudioTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $codec = null;
    protected int|null $rate = null;
    protected int|null $channelCount = null;
    protected string|null $channelLayout = null;

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
        return $this->channelCount;
    }

    public function getChannelLayout(): string|null
    {
        return $this->channelLayout;
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

    public function setChannelCount(int|null $channelCount): self
    {
        $this->channelCount = $channelCount;

        return $this;
    }

    public function setChannelLayout(string|null $channelLayout): self
    {
        $this->channelLayout = $channelLayout;

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
          'channelCount' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'channelCount',
          ),
          'channelLayout' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'channelLayout',
          ),
        );
    }
}
