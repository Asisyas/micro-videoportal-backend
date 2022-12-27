<?php

namespace App\Client\File\Expander\File;

use App\Shared\Generated\DTO\File\FileTransfer;

class FileTransferExpander implements FileTransferExpanderInterface
{
    /**
     * @var FileTransferExpanderInterface[]
     */
    private readonly iterable $transferExpanderCollection;

    /**
     * @param FileTransferExpanderInterface ...$transferExpanderCollection
     */
    public function __construct(
        FileTransferExpanderInterface ...$transferExpanderCollection
    ) {
        $this->transferExpanderCollection = $transferExpanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function expand(FileTransfer $fileTransfer): void
    {
        foreach ($this->transferExpanderCollection as $expander) {
            $expander->expand($fileTransfer);
        }
    }
}
