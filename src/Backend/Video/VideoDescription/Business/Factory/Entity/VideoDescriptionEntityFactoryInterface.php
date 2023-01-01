<?php

namespace App\Backend\Video\VideoDescription\Business\Factory\Entity;

use App\Backend\Video\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;

interface VideoDescriptionEntityFactoryInterface
{
    /**
     * @param VideoDescriptionPutTransfer $videoDescriptionPutTransfer
     *
     * @return VideoDescription
     */
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): VideoDescription;
}
