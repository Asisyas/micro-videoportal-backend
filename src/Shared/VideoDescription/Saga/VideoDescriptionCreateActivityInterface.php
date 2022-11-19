<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'video.description_')]
interface VideoDescriptionCreateActivityInterface extends ActivityInterface
{
    /**
     * @param VideoDescriptionPutTransfer $videoDescriptionPutTransfer
     *
     * @return mixed
     */
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer);
}