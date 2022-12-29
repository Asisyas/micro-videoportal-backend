<?php

namespace App\Backend\File\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'file')]
class File
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', length: 150, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(name: 'file_name', type: 'string', length: 150, unique: false, nullable: false)]
    private string $fileName;

    #[ORM\Column(name: 'content_type', type: 'string', length: 150, unique: false, nullable: false)]
    private string $contentType;

    #[ORM\Column(name: 'size', type: 'integer', nullable: false)]
    private int $size;

    #[ORM\Column(name: 'crc32', type: 'string', nullable: false)]
    private string $crc32 = '';

    #[ORM\Column(name: 'created_at', type: 'datetimetz', nullable: false)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(name: 'is_ready', type: 'boolean', nullable: false)]
    private bool $isReady = false;

    /**
     * @param string $id
     * @param string $fileName
     * @param int $fileSize
     * @param string $contentType
     */
    public function __construct(
        string $id,
        string $fileName,
        int $fileSize,
        string $contentType
    ) {
        $this->contentType = $contentType;
        $this->id = $id;
        $this->fileName = $fileName;
        $this->size = $fileSize;
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return bool
     */
    public function isReady(): bool
    {
        return $this->isReady;
    }

    /**
     * @param bool $ready
     *
     * @return $this
     */
    public function setIsReady(bool $ready): self
    {
        $this->isReady = $ready;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param string $fileName
     *
     * @return $this
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @param int $size
     *
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * {@inheritDoc}
     */
    public function getCrc32(): string
    {
        return $this->crc32;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }
}
