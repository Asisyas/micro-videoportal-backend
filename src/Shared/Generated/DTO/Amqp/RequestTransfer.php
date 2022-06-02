<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Amqp;

use DateTimeInterface;

final class RequestTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $publisher;
    protected mixed $message;

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getMessage(): mixed
    {
        return $this->message;
    }

    public function setPublisher(string $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function setMessage(mixed $message): self
    {
        $this->message = $message;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'publisher' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'publisher',
          ),
          'message' =>
          array (
            'type' =>
            array (
              0 => 'mixed',
            ),
            'required' => true,
            'actionName' => 'message',
          ),
        );
    }
}
