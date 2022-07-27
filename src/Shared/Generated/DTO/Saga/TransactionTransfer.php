<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Saga;

use DateTimeInterface;

final class TransactionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $id;
    protected CommandTransfer $command;
    protected int $status;

    public function getId(): string
    {
        return $this->id;
    }

    public function getCommand(): CommandTransfer
    {
        return $this->command;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setCommand(CommandTransfer $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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
          'command' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Saga\\CommandTransfer',
            ),
            'required' => true,
            'actionName' => 'command',
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
        );
    }
}
