<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use Micro\Library\DTO\Object\AbstractDto;

final class CategoryCreateTransfer extends AbstractDto
{
    /**
     * @var string|null
     */
    protected string|null $name;

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
     * @return CategoryCreateTransfer
     */
    public function setName(string|null $name): self
    {
        $this->name = $name;

         return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected static function attributesMetadata(): array
    {
        return array (
          'name' =>
          array (
            'is_collection' => false,
            'type' => 'string',
            'actionName' => 'Name',
            'required' => 'true',
          ),
        );
    }
}
