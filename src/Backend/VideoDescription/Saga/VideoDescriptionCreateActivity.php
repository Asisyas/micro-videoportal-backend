<?php

namespace App\Backend\VideoDescription\Saga;

use App\Backend\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
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
    public function create(VideoDescriptionTransfer $videoDescriptionTransfer)
    {
        yield $this->videoDescriptionFacade->create($videoDescriptionTransfer);
    }
}