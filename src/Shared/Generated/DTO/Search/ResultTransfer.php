<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Search;

use DateTimeInterface;
use Micro\Library\DTO\Object\AbstractDto;

final class ResultTransfer extends AbstractDto
{
    protected string|null $type = null;
    protected AbstractDto|null $source = null;

    public function getType(): string|null
    {
        return $this->type;
    }

    public function getSource(): AbstractDto|null
    {
        return $this->source;
    }

    public function setType(string|null $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setSource(AbstractDto|null $source): self
    {
        $this->source = $source;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'type' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'type',
          ),
          'source' =>
          array (
            'type' =>
            array (
              0 => 'Micro\\Library\\DTO\\Object\\AbstractDto',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'source',
          ),
        );
    }
}
