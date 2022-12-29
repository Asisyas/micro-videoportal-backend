<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'video.description_')]
interface VideoDescriptionUpdateActivityInterface extends ActivityInterface
{
    /**
     * @param VideoDescriptionPutTransfer $videoDescriptionPutTransfer
     *
     * @return bool
     */
    public function update(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool;
}
