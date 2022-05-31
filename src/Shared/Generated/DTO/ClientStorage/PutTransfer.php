<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\ClientStorage;

use Micro\Library\DTO\Object\AbstractDto;

final class PutTransfer extends AbstractDto
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
     * @var array|string|null
     */
    protected array|string|null $data;

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
     * @return PutTransfer
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
     * @return PutTransfer
     */
    public function setIndex(string|null $index): self
    {
        $this->index = $index;

         return $this;
    }

    /**
     * @return array|string|null
     */
    public function getData(): array|string|null
    {
        return $this->data;
    }

    /**
     * @param array|string|null $data
     *
     * @return PutTransfer
     */
    public function setData(array|string|null $data): self
    {
        $this->data = $data;

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
          'data' =>
          array (
            'is_collection' => false,
            'type' => 'array|string',
            'actionName' => 'Data',
            'required' => 'true',
          ),
        );
    }
}
