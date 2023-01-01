<?php

namespace App\Backend\Video\VideoDescription\Saga;

use App\Backend\Video\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\VideoDescription\Saga\VideoDescriptionUpdateActivityInterface;

class VideoDescriptionUpdateActivity implements VideoDescriptionUpdateActivityInterface
{
    /**
     * @param VideoDescriptionFacadeInterface $videoDescriptionFacade
     */
    public function __construct(
        private readonly VideoDescriptionFacadeInterface $videoDescriptionFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function update(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool
    {
        return $this->videoDescriptionFacade->update($videoDescriptionPutTransfer);
    }
}
