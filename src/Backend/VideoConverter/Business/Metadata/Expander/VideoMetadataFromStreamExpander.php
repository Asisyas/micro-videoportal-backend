<?php

namespace App\Backend\VideoConverter\Business\Metadata\Expander;

use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;
use FFMpeg\FFProbe\DataMapping\Stream;

class VideoMetadataFromStreamExpander implements VideoMetadataExpanderInterface
{
    /**
     * @var VideoMetadataExpanderInterface[]
     */
    private iterable $videoMetadataExpanderCollection;

    /**
     * @param VideoMetadataExpanderInterface ...$videoMetadataExpanderCollection
     */
    public function __construct(
        VideoMetadataExpanderInterface ...$videoMetadataExpanderCollection
    )
    {
        $this->videoMetadataExpanderCollection = $videoMetadataExpanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoMetadataTransfer $metadataTransfer, Stream $stream): void
    {
        foreach ($this->videoMetadataExpanderCollection as $expander) {
            $expander->expand($metadataTransfer, $stream);
        }
    }
}