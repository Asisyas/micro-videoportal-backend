<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class VideoConvertCollectionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected iterable $items;

    public function getItems(): iterable
    {
        return $this->items;
    }

    public function setItems(iterable $items): self
    {
        if (!$items) {
            $this->items = null;

            return $this;
        }

        if (!$this->items) {
            $this->items = new Collection();
        }

        foreach ($items as $item) {
            $this->items->add($item);
        }

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'items' =>
          array(
            'type' =>
            array(
              0 => 'iterable',
            ),
            'required' => true,
            'actionName' => 'items',
          ),
        );
    }
}
