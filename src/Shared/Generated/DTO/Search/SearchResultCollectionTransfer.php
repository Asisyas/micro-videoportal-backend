<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Search;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class SearchResultCollectionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected int|null $total = null;
    protected iterable|null $results = null;

    public function getTotal(): int|null
    {
        return $this->total;
    }

    public function getResults(): iterable|null
    {
        return $this->results;
    }

    public function setTotal(int|null $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function setResults(iterable|null $results): self
    {
        if (!$results) {
            $this->results = null;

            return $this;
        }

        if (!$this->results) {
            $this->results = new Collection();
        }

        foreach ($results as $item) {
            $this->results->add($item);
        }

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'total' =>
          array(
            'type' =>
            array(
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'total',
          ),
          'results' =>
          array(
            'type' =>
            array(
              0 => 'iterable',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'results',
          ),
        );
    }
}
