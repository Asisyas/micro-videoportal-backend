<?php

namespace App\Backend\VideoDescription\Business\Factory\Transfer;

use App\Backend\VideoDescription\Entity\VideoDescription;
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
