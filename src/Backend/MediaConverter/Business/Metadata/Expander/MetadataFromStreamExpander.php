<?php

namespace App\Backend\MediaConverter\Business\Metadata\Expander;

use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

class MetadataFromStreamExpander implements MetadataExpanderInterface
{
    /**
     * @var MetadataExpanderInterface[]
     */
    private iterable $videoMetadataExpanderCollection;

    /**
     * @param MetadataExpanderInterface ...$videoMetadataExpanderCollection
     */
    public function __construct(
        MetadataExpanderInterface ...$videoMetadataExpanderCollection
    )
    {
        $this->videoMetadataExpanderCollection = $videoMetadataExpanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function expand(MediaMetadataTransfer $metadataTransfer, Stream $stream): void
    {
        foreach ($this->videoMetadataExpanderCollection as $expander) {
            $expander->expand($metadataTransfer, $stream);
        }
    }
}