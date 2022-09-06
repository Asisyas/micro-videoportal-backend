<?php

namespace App\Backend\File\Facade;

use App\Backend\File\Business\File\Factory\FileFactoryInterface;
use App\Shared\Generated\DTO\File\ChunkRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

class FileFacade implements FileFacadeInterface
{
    /**
     * @param FileFactoryInterface $fileFactory]
     */
    public function __construct(private readonly FileFactoryInterface $fileFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileTransfer
    {
        return $this->fileFactory->create($fileCreateTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function uploadFile(ChunkRequestTransfer $chunkRequestTransfer): ChunkResponseTransfer
    {
    }
}