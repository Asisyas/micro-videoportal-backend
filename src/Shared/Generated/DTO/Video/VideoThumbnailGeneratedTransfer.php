<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Video;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class VideoThumbnailGeneratedTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected iterable|null $results = null;

    public function getResults(): iterable|null
    {
        return $this->results;
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
