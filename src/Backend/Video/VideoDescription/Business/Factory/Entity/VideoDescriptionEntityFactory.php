<?php

namespace App\Backend\Video\VideoDescription\Business\Factory\Entity;

use App\Backend\Video\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderFactoryInterface;
use App\Backend\Video\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;

class VideoDescriptionEntityFactory implements VideoDescriptionEntityFactoryInterface
{
    /**
     * @param VideoDescriptionEntityExpanderFactoryInterface $videoDescriptionEntityExpanderFactory
     */
    public function __construct(
        private readonly VideoDescriptionEntityExpanderFactoryInterface $videoDescriptionEntityExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): VideoDescription
    {
        $videoId    = $videoDescriptionPutTransfer->getVideoId();
        $entity     =  new VideoDescription($videoId);

        $this->videoDescriptionEntityExpanderFactory
            ->create()
            ->expand($entity, $videoDescriptionPutTransfer->getSource());

        return $entity;
    }
}
