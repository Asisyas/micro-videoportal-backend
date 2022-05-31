<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use Micro\Library\DTO\Object\AbstractDto;

final class CategoryTransfer extends AbstractDto
{
    /**
     * @var string|null
     */
    protected string|null $uuid;

    /**
     * @var string|null
     */
    protected string|null $name;

    /**
     * @var App\Shared\Generated\DTO\Category\CategoryTransfer
     */
    protected CategoryTransfer $parent;

    /**
     * @return string|null
     */
    public function getUuid(): string|null
    {
        return $this->uuid;
    }

    /**
     * @param string|null $uuid
     *
     * @return CategoryTransfer
     */
    public function setUuid(string|null $uuid): self
    {
        $this->uuid = $uuid;

         return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): string|null
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return CategoryTransfer
     */
    public function setName(string|null $name): self
    {
        $this->name = $name;

         return $this;
    }

    /**
     * @return App\Shared\Generated\DTO\Category\CategoryTransfer
     */
    public function getParent(): CategoryTransfer
    {
        return $this->parent;
    }

    /**
     * @param App\Shared\Generated\DTO\Category\CategoryTransfer $parent
     *
     * @return CategoryTransfer
     */
    public function setParent(CategoryTransfer $parent): self
    {
        $this->parent = $parent;

         return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected static function attributesMetadata(): array
    {
        return array (
          'uuid' =>
          array (
            'is_collection' => false,
            'type' => 'string',
            'actionName' => 'Uuid',
            'required' => 'true',
          ),
          'name' =>
          array (
            'is_collection' => false,
            'type' => 'string',
            'actionName' => 'Name',
            'required' => 'true',
          ),
          'parent' =>
          array (
            'is_collection' => false,
            'type' => 'CategoryTransfer',
            'actionName' => 'Parent',
            'required' => false,
          ),
        );
    }
}
