<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'video.description_')]
interface VideoDescriptionDeleteActivityInterface extends ActivityInterface
{
    /**
     * @param VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer
     *
     * @return void
     */
    public function delete(VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer): void;
}