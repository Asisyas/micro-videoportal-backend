<?php

namespace App\Backend\Video\VideoDescription\Business\Expander\Entity;

use App\Backend\Video\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;

class VideoDescriptionEntityExpander implements VideoDescriptionEntityExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(VideoDescription $videoDescription, VideoDescriptionTransfer $videoDescriptionTransfer): void
    {
        $videoDescription
            ->setDescription($videoDescriptionTransfer->getDescription() ?: '')
            ->setTitle($videoDescriptionTransfer->getTitle())
        ;
    }
}
