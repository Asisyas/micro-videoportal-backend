<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Amqp;

use DateTimeInterface;

final class RpcResponseTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected mixed $content;

    public function getContent(): mixed
    {
        return $this->content;
    }

    public function setContent(mixed $content): self
    {
        $this->content = $content;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'content' =>
          array (
            'type' =>
            array (
              0 => 'mixed',
            ),
            'required' => true,
            'actionName' => 'content',
          ),
        );
    }
}
