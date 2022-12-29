<?php

namespace App\Shared\VideoChannel\Saga;

use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\VideoChannel\Exception\ChannelIdAlreadyExistsException;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface]
interface VideoChannelActivityInterface extends ActivityInterface
{

}
