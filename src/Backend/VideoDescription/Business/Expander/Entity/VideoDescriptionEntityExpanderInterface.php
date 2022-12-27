<?php

namespace App\Backend\VideoDescription\Business\Expander\Entity;

use App\Backend\VideoDescription\Entity\VideoDescription;
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
