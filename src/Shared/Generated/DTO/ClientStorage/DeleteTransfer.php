<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\ClientStorage;

use Micro\Library\DTO\Object\AbstractDto;

final class DeleteTransfer extends AbstractDto
{
    /**
     * @var string|null
     */
    protected string|null $uuid;

    /**
     * @var string|null
     */
    protected string|null $index;

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
     * @return DeleteTransfer
     */
    public function setUuid(string|null $uuid): self
    {
        $this->uuid = $uuid;

         return $this;
    }

    /**
     * @return string|null
     */
    public function getIndex(): string|null
    {
        return $this->index;
    }

    /**
     * @param string|null $index
     *
     * @return DeleteTransfer
     */
    public function setIndex(string|null $index): self
    {
        $this->index = $index;

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
          'index' =>
          array (
            'is_collection' => false,
            'type' => 'string',
            'actionName' => 'Index',
            'required' => 'true',
          ),
        );
    }
}
