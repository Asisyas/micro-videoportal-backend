<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Saga;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class SagaTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $name;
    protected iterable $steps;

    public function getName(): string
    {
        return $this->name;
    }

    public function getSteps(): iterable
    {
        return $this->steps;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setSteps(iterable $steps): self
    {
        if(!$steps) {
                        $this->steps = null;

                        return $this;
                    }

                    if(!$this->steps) {
                        $this->steps = new Collection();
                    }

                    foreach($steps as $item) {
                        $this->steps->add($item);
                    }

                    return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'name' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'name',
          ),
          'steps' =>
          array (
            'type' =>
            array (
              0 => 'iterable',
            ),
            'required' => true,
            'actionName' => 'steps',
          ),
        );
    }
}
