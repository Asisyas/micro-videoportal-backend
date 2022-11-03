<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConverter;

use DateTimeInterface;

final class VideoMetadataTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $format = null;
    protected StreamVideoTransfer|null $streamVideo = null;
    protected StreamAudioTransfer|null $streamAudio = null;

    public function getFormat(): string|null
    {
        return $this->format;
    }

    public function getStreamVideo(): StreamVideoTransfer|null
    {
        return $this->streamVideo;
    }

    public function getStreamAudio(): StreamAudioTransfer|null
    {
        return $this->streamAudio;
    }

    public function setFormat(string|null $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function setStreamVideo(StreamVideoTransfer|null $streamVideo): self
    {
        $this->streamVideo = $streamVideo;

        return $this;
    }

    public function setStreamAudio(StreamAudioTransfer|null $streamAudio): self
    {
        $this->streamAudio = $streamAudio;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'format' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'format',
          ),
          'streamVideo' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\VideoConverter\\StreamVideoTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'streamVideo',
          ),
          'streamAudio' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\VideoConverter\\StreamAudioTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'streamAudio',
          ),
        );
    }
}
