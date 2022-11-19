<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'video.description_')]
interface VideoDescriptionUpdateActivityInterface extends ActivityInterface
{
    /**
     * @param VideoDescriptionTransfer $videoDescriptionTransfer
     *
     * @return bool
     */
    public function update(VideoDescriptionTransfer $videoDescriptionTransfer): bool;
}