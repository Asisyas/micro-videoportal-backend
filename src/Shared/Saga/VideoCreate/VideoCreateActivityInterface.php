<?php

namespace App\Shared\Saga\VideoCreate;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'video_create.')]
interface VideoCreateActivityInterface extends ActivityInterface
{

}
