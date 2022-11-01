<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class SourceFileMetadataTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $format = null;
    protected int|null $length = null;
    protected string|null $name = null;
    protected iterable|null $resolution = null;

    public function getFormat(): string|null
    {
        return $this->format;
    }

    public function getLength(): int|null
    {
        return $this->length;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getResolution(): iterable|null
    {
        return $this->resolution;
    }

    public function setFormat(string|null $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function setLength(int|null $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function setName(string|null $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setResolution(iterable|null $resolution): self
    {
        if(!$resolution) {
                        $this->resolution = null;

                        return $this;
                    }

                    if(!$this->resolution) {
                        $this->resolution = new Collection();
                    }

                    foreach($resolution as $item) {
                        $this->resolution->add($item);
                    }

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
          'length' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'length',
          ),
          'name' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'name',
          ),
          'resolution' =>
          array (
            'type' =>
            array (
              0 => 'iterable',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'resolution',
          ),
        );
    }
}
