<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;

final class SourceTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $src = null;

    public function getSrc(): string|null
    {
        return $this->src;
    }

    public function setSrc(string|null $src): self
    {
        $this->src = $src;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
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
