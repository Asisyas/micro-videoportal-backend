<?php

namespace App\Frontend\File\Expander\FileUpload;

use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Symfony\Component\HttpFoundation\Request;

class FileUploadTransferExpander implements FileUploadTransferExpanderInterface
{
    /**
     * @var iterable<FileUploadTransferExpanderInterface>
     */
    private iterable $expanderCollection;

    /**
     * @param FileUploadTransferExpanderInterface ...$expanderCollection
     */
    public function __construct(FileUploadTransferExpanderInterface ...$expanderCollection)
    {
        $this->expanderCollection = $expanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function expand(FileUploadTransfer $fileUploadTransfer, Request $request): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($fileUploadTransfer, $request);
        }
    }
}