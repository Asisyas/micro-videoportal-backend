<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\File;

use DateTimeInterface;

final class FileGetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'id' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'id',
          ),
        );
    }
}
