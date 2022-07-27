<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Saga;

use DateTimeInterface;

final class SagaStepTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $name;
    protected string $stepSuccess;
    protected string $stepFail;

    public function getName(): string
    {
        return $this->name;
    }

    public function getStepSuccess(): string
    {
        return $this->stepSuccess;
    }

    public function getStepFail(): string
    {
        return $this->stepFail;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setStepSuccess(string $stepSuccess): self
    {
        $this->stepSuccess = $stepSuccess;

        return $this;
    }

    public function setStepFail(string $stepFail): self
    {
        $this->stepFail = $stepFail;

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
          'stepSuccess' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'stepSuccess',
          ),
          'stepFail' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'stepFail',
          ),
        );
    }
}
