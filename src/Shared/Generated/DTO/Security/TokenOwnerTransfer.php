<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Security;

use DateTimeInterface;

final class TokenOwnerTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $id = null;
    protected string|null $email = null;
    protected string|null $name_first = null;
    protected string|null $name_last = null;

    public function getId(): string|null
    {
        return $this->id;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function getNameFirst(): string|null
    {
        return $this->name_first;
    }

    public function getNameLast(): string|null
    {
        return $this->name_last;
    }

    public function setId(string|null $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setEmail(string|null $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setNameFirst(string|null $name_first): self
    {
        $this->name_first = $name_first;

        return $this;
    }

    public function setNameLast(string|null $name_last): self
    {
        $this->name_last = $name_last;

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
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'id',
          ),
          'email' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'email',
          ),
          'name_first' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'nameFirst',
          ),
          'name_last' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'nameLast',
          ),
        );
    }
}
