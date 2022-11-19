<?php

namespace App\Shared\ClientStorage\Saga;

use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface]
interface ClientStoragePutActivityInterface extends ActivityInterface
{
    /**
     * @param PutTransfer $putTransfer
     *
     * @return bool
     */
    public function put(PutTransfer $putTransfer): bool;
}