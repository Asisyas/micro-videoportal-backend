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

    #[ORM\Column(type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private string|null $src;

    #[ORM\Column(type: 'string', length: 200, nullable: false)]
    private string $channelId;

    /**
     * @param string $id
     * @param string $channelId
     */
    public function __construct(string $id, string $channelId)
    {
        $this->id =$id;
        $this->src = null;
        $this->channelId = $channelId;
        $this->createdAt = new DateTime('now');
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getSrc(): string|null
    {
        return $this->src;
    }

    /**
     * @param string|null $src
     *
     * @return self
     */
    public function setSrc(string|null $src): self
    {
        $this->src = $src;

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
     * @return string
     */
    public function getChannelId(): string
    {
        return $this->channelId;
    }
}
