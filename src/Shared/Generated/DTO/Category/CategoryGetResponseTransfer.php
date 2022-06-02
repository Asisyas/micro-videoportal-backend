<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use DateTimeInterface;

final class CategoryGetResponseTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected CategoryTransfer $category;
    protected int $flag;

    public function getCategory(): CategoryTransfer
    {
        return $this->category;
    }

    public function getFlag(): int
    {
        return $this->flag;
    }

    public function setCategory(CategoryTransfer $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function setFlag(int $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'category' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Category\\CategoryTransfer',
            ),
            'required' => true,
            'actionName' => 'category',
          ),
          'flag' =>
          array (
            'type' =>
            array (
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'flag',
          ),
        );
    }
}
