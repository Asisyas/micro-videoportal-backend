<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Search;

use DateTimeInterface;
use Micro\Library\DTO\Object\AbstractDto;

final class IndexAddTransfer extends AbstractDto
{
    protected string|null $index = null;
    protected AbstractDto|null $body = null;
    protected string|null $id = null;

    public function getIndex(): string|null
    {
        return $this->index;
    }

    public function getBody(): AbstractDto|null
    {
        return $this->body;
    }

    public function getId(): string|null
    {
        return $this->id;
    }

    public function setIndex(string|null $index): self
    {
        $this->index = $index;

        return $this;
    }

    public function setBody(AbstractDto|null $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setId(string|null $id): self
    {
        $this->id = $id;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'index' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'index',
          ),
          'body' =>
          array(
            'type' =>
            array(
              0 => 'Micro\\Library\\DTO\\Object\\AbstractDto',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'body',
          ),
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
        );
    }
}
