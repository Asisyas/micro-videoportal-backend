<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Amqp;

use DateTimeInterface;
use Micro\Library\DTO\Object\AbstractDto;

final class TaskStatusResponseTransfer extends AbstractDto
{
    protected string $channel_id;
    protected int $status;
    protected AbstractDto|null|string $result = null;
    protected DateTimeInterface|null $updatedAt = null;
    protected DateTimeInterface $createdAt;

    public function getChannelId(): string
    {
        return $this->channel_id;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getResult(): AbstractDto|null|string
    {
        return $this->result;
    }

    public function getUpdatedAt(): DateTimeInterface|null
    {
        return $this->updatedAt;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setChannelId(string $channel_id): self
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setResult(AbstractDto|null|string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function setUpdatedAt(DateTimeInterface|null $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'channel_id' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'channelId',
          ),
          'status' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'status',
          ),
          'result' =>
          array (
            'type' =>
            array (
              0 => 'Micro\\Library\\DTO\\Object\\AbstractDto',
              1 => 'null',
              2 => 'string',
            ),
            'required' => false,
            'actionName' => 'result',
          ),
          'updatedAt' =>
          array (
            'type' =>
            array (
              0 => 'DateTimeInterface',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'updatedAt',
          ),
          'createdAt' =>
          array (
            'type' =>
            array (
              0 => 'DateTimeInterface',
            ),
            'required' => true,
            'actionName' => 'createdAt',
          ),
        );
    }
}
