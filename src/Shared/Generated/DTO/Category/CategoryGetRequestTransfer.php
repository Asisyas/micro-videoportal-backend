<?php
declare(strict_types=1);

namespace App\Shared\Generated\DTO\Category;

use Micro\Library\DTO\Object\AbstractDto;

/**
 * Autogenerated data transfer object.
 *
 */
class CategoryGetRequestTransfer extends AbstractDto
{
    /**
    * @var string    */
    protected string $uuid;

    /**
    * @var int    */
    protected int $flag;


    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return int
     */
    public function getFlag(): int
    {
        return $this->flag;
    }

    /**
     * @param int $flag
     *
     * @return self
     */
    public function setFlag(int $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @returns array
     */
    public function toArray(): array
    {
        return [
            'uuid'       => ($this->uuid instanceof AbstractDto ? $this->uuid->toArray() : $this->uuid),
            'flag'       => ($this->flag instanceof AbstractDto ? $this->flag->toArray() : $this->flag),
        ];
    }

    /**
    * {@inheritdoc}
    */
    protected function attributesMetadata(): array
    {
        return [
            'uuid' => [
                'is_collection'     =>   false ,
                'type'              => 'string',
                'actionName'        => 'Uuid',
                'required'          => true,
                'dto'               =>  false ,
            ],

            'flag' => [
                'is_collection'     =>   false ,
                'type'              => 'int',
                'actionName'        => 'Flag',
                'required'          => true,
                'dto'               =>  false ,
            ],

        ];
    }
}

