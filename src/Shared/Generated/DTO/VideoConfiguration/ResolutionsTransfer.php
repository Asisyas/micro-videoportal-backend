<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConfiguration;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class ResolutionsTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected iterable|null $resolutions = null;

    public function getResolutions(): iterable|null
    {
        return $this->resolutions;
    }

    public function setResolutions(iterable|null $resolutions): self
    {
        if (!$resolutions) {
            $this->resolutions = null;

            return $this;
        }

        if (!$this->resolutions) {
            $this->resolutions = new Collection();
        }

        foreach ($resolutions as $item) {
            $this->resolutions->add($item);
        }

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'resolutions' =>
          array(
            'type' =>
            array(
              0 => 'iterable',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'resolutions',
          ),
        );
    }
}
