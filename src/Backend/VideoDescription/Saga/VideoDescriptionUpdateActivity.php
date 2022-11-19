<?php

namespace App\Backend\VideoDescription\Saga;

use App\Backend\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\VideoDescription\Saga\VideoDescriptionUpdateActivityInterface;

class VideoDescriptionUpdateActivity implements VideoDescriptionUpdateActivityInterface
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
    public function update(VideoDescriptionTransfer $videoDescriptionTransfer): bool
    {
        return $this->videoDescriptionFacade->update($videoDescriptionTransfer);
    }
}