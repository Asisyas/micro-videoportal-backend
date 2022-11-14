<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class PublishStatusTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    /** Video Unique ID */
    protected string|null $id = null;
    protected iterable|null $resolutions = null;
    protected int|null $status = null;

    public function getId(): string|null
    {
        return $this->id;
    }

    public function getResolutions(): iterable|null
    {
        return $this->resolutions;
    }

    public function getStatus(): int|null
    {
        return $this->status;
    }

    public function setId(string|null $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setResolutions(iterable|null $resolutions): self
    {
        if(!$resolutions) {
                        $this->resolutions = null;

                        return $this;
                    }

                    if(!$this->resolutions) {
                        $this->resolutions = new Collection();
                    }

                    foreach($resolutions as $item) {
                        $this->resolutions->add($item);
                    }

                    return $this;
    }

    public function setStatus(int|null $status): self
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
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'id',
          ),
          'resolutions' =>
          array (
            'type' =>
            array (
              0 => 'iterable',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'resolutions',
          ),
          'status' =>
          array (
            'type' =>
            array (
              0 => 'int',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'status',
          ),
        );
    }
}
