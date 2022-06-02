<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\ActionStatus;

use DateTimeInterface;
use Micro\Library\DTO\Object\AbstractDto;

final class ResponseTransfer extends AbstractDto
{
    protected string $channel_id;
    protected int $status;
    protected AbstractDto|null|string $result = null;

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
        );
    }
}
