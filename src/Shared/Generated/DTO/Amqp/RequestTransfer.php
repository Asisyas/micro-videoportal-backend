<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Amqp;

use Micro\Library\DTO\Object\AbstractDto;

final class RequestTransfer extends AbstractDto
{
    /**
     * @var string|null
     */
    protected string|null $publisher;

    /**
     * @var mixed
     */
    protected mixed $message = null;

    /**
     * @return string|null
     */
    public function getPublisher(): string|null
    {
        return $this->publisher;
    }

    /**
     * @param string|null $publisher
     *
     * @return RequestTransfer
     */
    public function setPublisher(string|null $publisher): self
    {
        $this->publisher = $publisher;

         return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage(): mixed
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     *
     * @return RequestTransfer
     */
    public function setMessage(mixed $message): self
    {
        $this->message = $message;

         return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected static function attributesMetadata(): array
    {
        return array (
          'publisher' =>
          array (
            'is_collection' => false,
            'type' => 'string',
            'actionName' => 'Publisher',
            'required' => 'true',
          ),
          'message' =>
          array (
            'is_collection' => false,
            'type' => 'mixed',
            'actionName' => 'Message',
            'required' => 'true',
          ),
        );
    }
}
