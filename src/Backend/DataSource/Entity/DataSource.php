<?php

namespace App\Backend\DataSource\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DataSource
{
    #[ORM\Id]
    #[ORM\Column(name: 'guid', type: 'string', length: 150, unique: true, nullable: false)]
    private string $uuid;

    #[ORM\Column(name: 'name', type: 'string', length: 150, unique: false, nullable: false)]
    private string $name;

    #[ORM\Column(name: 'type', type: 'string', length: 30, unique: false, nullable: false)]
    private string $type;

   // #[ORM\Column(name: 'data_source_configuration')]
  //  private DataSourceConfigurationInterface $dataSourceConfiguration;

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
     * @return DataSource
     */
    public function setName(string $name): DataSource
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return DataSource
     */
    public function setType(string $type): DataSource
    {
        $this->type = $type;
        return $this;
    }
}