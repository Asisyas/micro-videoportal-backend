<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class MediaMetadataTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $format = null;
    protected iterable|null $streams = null;

    public function getFormat(): string|null
    {
        return $this->format;
    }

    public function getStreams(): iterable|null
    {
        return $this->streams;
    }

    public function setFormat(string|null $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function setStreams(iterable|null $streams): self
    {
        if (!$streams) {
            $this->streams = null;

            return $this;
        }

        if (!$this->streams) {
            $this->streams = new Collection();
        }

        foreach ($streams as $item) {
            $this->streams->add($item);
        }

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'format' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'format',
          ),
          'streams' =>
          array(
            'type' =>
            array(
              0 => 'iterable',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'streams',
          ),
        );
    }
}
