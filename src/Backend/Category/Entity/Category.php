<?php

namespace App\Backend\DataSource\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Category
{
    #[ORM\Id]
    #[ORM\Column(name: 'guid', type: 'string', length: 150, unique: true, nullable: false)]
    private string $uuid;

    #[ORM\Column(name: 'name', type: 'string', length: 150, unique: false, nullable: false)]
    private string $name;

    #[ORM\Column(name: 'parent_category_uuid', type: 'string', length: 150, unique: false, nullable: true)]
    private string $parentCategoryUuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * {@inheritDoc}
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getParentCategoryUuid(): ?string
    {
        return $this->parentCategoryUuid;
    }

    /**
     * @param string|null $parentCategoryUuid
     *
     * @return Category
     */
    public function setParentCategoryUuid(?string $parentCategoryUuid): Category
    {
        $this->parentCategoryUuid = $parentCategoryUuid;

        return $this;
    }
}