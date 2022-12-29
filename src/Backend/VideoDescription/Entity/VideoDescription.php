<?php

namespace App\Backend\VideoDescription\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'video_description')]
class VideoDescription
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 150, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(type: 'string', length: 150, unique: false, nullable: false)]
    private string $title;

    #[ORM\Column(type: 'text', unique: false, nullable: false)]
    private string $description;

    /**
     * @param string $videoId
     * @param string $title
     * @param string $description
     */
    public function __construct(string $videoId, string $title = '', string $description = '')
    {
        $this->id = $videoId;
        $this->title = $title;
        $this->description = $description;
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
}
