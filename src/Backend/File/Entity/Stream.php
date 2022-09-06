<?php

namespace App\Backend\File\Entity;

use App\Backend\File\Model\StreamInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'file_upload_stream')]
class Stream implements StreamInterface
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', length: 150, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column(name: 'file_size', type: 'integer', nullable: false)]
    private int $fileSize;

    #[ORM\Column(name: 'chunk_size', type: 'integer', nullable: false)]
    private int $chunkSize;

    #[ORM\Column(name: 'chunk_count', type: 'integer', nullable: false)]
    private int $chunkCount;

    #[ORM\Column(name: 'file_id', type: 'string', length: 150, unique: true, nullable: false)]
    private string $fileId;

    public function __construct(
        string $id,
        string $fileId,
        int $fileSize,
        int $chunkSize,
        int $chunkCount,
    )
    {
        $this->id = $id;
        $this->fileId = $fileId;
        $this->fileSize = $fileSize;
        $this->chunkCount = $chunkCount;
        $this->chunkSize = $chunkSize;
    }

    /**
     * @return string
     */
    public function getFileId(): string
    {
        return $this->fileId;
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
     * @return int
     */
    public function getSize(): int
    {
        return $this->fileSize;
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
}