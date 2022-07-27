<?php

namespace App\Backend\File\Entity;

use App\Backend\File\Model\ChannelInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Channel implements ChannelInterface
{
    #[ORM\Id]
    #[ORM\Column(name: 'guid', type: 'string', length: 150, unique: true, nullable: false)]
    private string $uuid;

    #[ORM\Column(name: 'file_name', type: 'string', length: 150, unique: false, nullable: false)]
    private string $fileName;

    #[ORM\Column(name: 'size', type: 'integer', nullable: false)]
    private int $size;

    #[ORM\Column(name: 'chunk_size', type: 'integer', nullable: false)]
    private int $chunkSize;

    #[ORM\Column(name: 'chunk_count', type: 'integer', nullable: false)]
    private int $chunkCount;

    #[ORM\Column(name: 'crc32', type: 'string', nullable: false)]
    private string $crc32 = '';

    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
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
    public function setChunkSize(int $size): self
    {
        $this->chunkSize = $size;

        return $this;
    }

    /**
     * @param int $chunkCount
     *
     * @return $this
     */
    public function setChunkCount(int $chunkCount): self
    {
        $this->chunkCount = $chunkCount;

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
    public function getUuid(): string
    {
        return $this->uuid;
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
    public function getChunkSize(): int
    {
        return $this->chunkSize;
    }

    /**
     * {@inheritDoc}
     */
    public function getChunkCount(): int
    {
        return $this->chunkCount;
    }

    /**
     * {@inheritDoc}
     */
    public function getCrc32(): string
    {
        return $this->crc32;
    }
}