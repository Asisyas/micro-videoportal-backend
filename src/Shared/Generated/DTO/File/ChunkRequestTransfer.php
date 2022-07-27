<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class ChunkRequestTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $channel;
    protected int $chunk;
    protected string $blob;

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getChunk(): int
    {
        return $this->chunk;
    }

    public function getBlob(): string
    {
        return $this->blob;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function setChunk(int $chunk): self
    {
        $this->chunk = $chunk;

        return $this;
    }

    public function setBlob(string $blob): self
    {
        $this->blob = $blob;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'channel' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'channel',
          ),
          'chunk' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'chunk',
          ),
          'blob' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'blob',
          ),
        );
    }
}
