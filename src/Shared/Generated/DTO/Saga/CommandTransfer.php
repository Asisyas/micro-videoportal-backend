<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Saga;

use DateTimeInterface;
use Micro\Library\DTO\Object\AbstractDto;

final class CommandTransfer extends AbstractDto
{
    protected string $id;
    protected string $name;
    protected AbstractDto $data;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): AbstractDto
    {
        return $this->data;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setData(AbstractDto $data): self
    {
        $this->data = $data;

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
          'name' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'name',
          ),
          'data' =>
          array (
            'type' =>
            array (
              0 => 'Micro\\Library\\DTO\\Object\\AbstractDto',
            ),
            'required' => true,
            'actionName' => 'data',
          ),
        );
    }
}
