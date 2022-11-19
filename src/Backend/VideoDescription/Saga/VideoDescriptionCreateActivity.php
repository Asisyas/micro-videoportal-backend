<?php

namespace App\Backend\VideoDescription\Saga;

use App\Backend\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\VideoDescription\Saga\VideoDescriptionCreateActivityInterface;

class VideoDescriptionCreateActivity implements VideoDescriptionCreateActivityInterface
{
    /**
     * @param VideoDescriptionFacadeInterface $videoDescriptionFacade
     */
    public function __construct(
        private readonly VideoDescriptionFacadeInterface $videoDescriptionFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer)
    {
        return $this->videoDescriptionFacade->create($videoDescriptionPutTransfer);
    }
}