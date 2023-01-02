<?php

namespace App\Backend\Video\VideoDescription\Business\Factory\Transfer;

use App\Backend\Video\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;

interface VideoDescriptionTransferFactoryInterface
{
    /**
     * @param VideoDescription $videoDescription
     *
     * @return VideoDescriptionTransfer
     */
    public function create(VideoDescription $videoDescription): VideoDescriptionTransfer;
}
