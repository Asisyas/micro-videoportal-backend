<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Search;

use DateTimeInterface;

final class SearchTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected int|null $limit = null;
    protected int|null $offset = null;
    protected string|null $index = null;
    protected array|null $query = null;

    public function getLimit(): int|null
    {
        return $this->limit;
    }

    public function getOffset(): int|null
    {
        return $this->offset;
    }

    public function getIndex(): string|null
    {
        return $this->index;
    }

    public function getQuery(): array|null
    {
        return $this->query;
    }

    public function setLimit(int|null $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function setOffset(int|null $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function setIndex(string|null $index): self
    {
        $this->index = $index;

        return $this;
    }

    public function setQuery(array|null $query): self
    {
        $this->query = $query;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'limit' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'limit',
          ),
          'offset' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'offset',
          ),
          'index' =>
          array (
            'type' =>
            array (
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'index',
          ),
          'query' =>
          array (
            'type' =>
            array (
              0 => 'array',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'query',
          ),
        );
    }
}
