<?php

namespace App\Backend\VideoDescription\Business\Factory\Transfer;

use App\Backend\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;

class VideoDescriptionTransferFactory implements VideoDescriptionTransferFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(VideoDescription $videoDescription): VideoDescriptionTransfer
    {
        return (new VideoDescriptionTransfer())
            ->setTitle($videoDescription->getTitle())
            ->setDescription($videoDescription->getDescription())
            ;
    }
}