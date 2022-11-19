<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class VideoTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $id;
    protected string|null $src = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getSrc(): string|null
    {
        return $this->src;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setSrc(string|null $src): self
    {
        $this->src = $src;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'id',
          ),
          'src' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'src',
          ),
        );
    }
}
