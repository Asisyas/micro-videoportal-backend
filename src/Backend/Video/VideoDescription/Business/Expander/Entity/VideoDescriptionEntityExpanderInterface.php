<?php

namespace App\Backend\Video\VideoDescription\Business\Expander\Entity;

use App\Backend\Video\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;

interface VideoDescriptionEntityExpanderInterface
{
    /**
     * @param VideoDescription $videoDescription
     * @param VideoDescriptionTransfer $videoDescriptionTransfer
     *
     * @return void
     */
    public function expand(VideoDescription $videoDescription, VideoDescriptionTransfer $videoDescriptionTransfer): void;
}
