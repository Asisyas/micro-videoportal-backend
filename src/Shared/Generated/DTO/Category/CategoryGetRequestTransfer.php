<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use Micro\Library\DTO\Object\AbstractDto;

final class CategoryGetRequestTransfer extends AbstractDto
{
    /**
     * @var string|null
     */
    protected string|null $uuid;

    /**
     * @var int|null
     */
    protected int|null $flag;

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
     * @return CategoryGetRequestTransfer
     */
    public function setUuid(string|null $uuid): self
    {
        $this->uuid = $uuid;

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
     * @return CategoryGetRequestTransfer
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
          'uuid' =>
          array (
            'is_collection' => false,
            'type' => 'string',
            'actionName' => 'Uuid',
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
