<?php

namespace App\Backend\Video\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'video')]
class Video
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 150, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(type: 'string', length: 300, unique: false, nullable: false)]
    private string $title;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $description;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTime $updatedAt;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $mediaSrc = null;

    /**
     * @param string $id
     * @param string $title
     */
    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = '';
        $this->createdAt = new DateTime('now');
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new DateTime('now');
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): DateTime|null
    {
        return $this->updatedAt;
    }

    /**
     * @return null
     */
    public function getMediaSrc(): string|null
    {
        return $this->mediaSrc;
    }

    /**
     * @param string|null $mediaSrc
     *
     * @return self
     */
    public function setMediaSrc(string|null $mediaSrc): self
    {
        $this->mediaSrc = $mediaSrc;

        return $this;
    }
}