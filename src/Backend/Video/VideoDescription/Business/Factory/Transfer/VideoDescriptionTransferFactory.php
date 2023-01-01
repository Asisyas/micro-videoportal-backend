<?php

namespace App\Backend\Video\VideoDescription\Business\Factory\Transfer;

use App\Backend\Video\VideoDescription\Entity\VideoDescription;
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
