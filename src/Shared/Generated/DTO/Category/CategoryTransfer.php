<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use App\Shared\Generated\DTO\Category\CategoryTransfer as CategoryTransfer1;
use DateTimeInterface;

final class CategoryTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string $uuid;
    protected string $name;
    protected CategoryTransfer|null $parent = null;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParent(): CategoryTransfer|null
    {
        return $this->parent;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setParent(CategoryTransfer|null $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'uuid' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'uuid',
          ),
          'name' =>
          array (
            'type' =>
            array (
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'name',
          ),
          'parent' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Category\\CategoryTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'parent',
          ),
        );
    }
}
