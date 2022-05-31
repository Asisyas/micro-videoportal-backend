<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use Micro\Library\DTO\Object\AbstractDto;

final class CategoryGetResponseTransfer extends AbstractDto
{
    /**
     * @var App\Shared\Generated\DTO\Category\CategoryTransfer|null
     */
    protected CategoryTransfer|null $category;

    /**
     * @var int|null
     */
    protected int|null $flag;

    /**
     * @return App\Shared\Generated\DTO\Category\CategoryTransfer|null
     */
    public function getCategory(): CategoryTransfer|null
    {
        return $this->category;
    }

    /**
     * @param App\Shared\Generated\DTO\Category\CategoryTransfer|null $category
     *
     * @return CategoryGetResponseTransfer
     */
    public function setCategory(CategoryTransfer|null $category): self
    {
        $this->category = $category;

         return $this;
    }

    /**
     * @return int|null
     */
    public function getFlag(): int|null
    {
        return $this->flag;
    }

    /**
     * @param int|null $flag
     *
     * @return CategoryGetResponseTransfer
     */
    public function setFlag(int|null $flag): self
    {
        $this->flag = $flag;

         return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected static function attributesMetadata(): array
    {
        return array (
          'category' =>
          array (
            'is_collection' => false,
            'type' => 'CategoryTransfer',
            'actionName' => 'Category',
            'required' => 'true',
          ),
          'flag' =>
          array (
            'is_collection' => false,
            'type' => 'int',
            'actionName' => 'Flag',
            'required' => 'false',
          ),
        );
    }
}
