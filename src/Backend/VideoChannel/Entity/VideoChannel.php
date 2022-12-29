<?php

namespace App\Backend\VideoChannel\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'video_channel')]
class VideoChannel
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 150, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(type: 'string', unique: false, nullable: false)]
    private string $title;

    #[ORM\Column(type: 'datetime', unique: false, nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(type: 'string', unique: false, nullable: false)]
    private string $ownerId;

    /**
     * @param string $id
     * @param string $ownerId
     * @param string $title
     */
    public function __construct(
        string $id,
        string $ownerId,
        string $title
    ) {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->title = $title ?: $id;

        $this->createdAt = new DateTime('now');
    }

    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
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
}
