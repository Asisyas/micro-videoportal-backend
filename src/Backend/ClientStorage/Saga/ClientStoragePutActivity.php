<?php

namespace App\Backend\ClientStorage\Saga;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Shared\ClientStorage\Saga\ClientStoragePutActivityInterface;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;

class ClientStoragePutActivity implements ClientStoragePutActivityInterface
{
    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(
        private readonly ClientStorageFacadeInterface $clientStorageFacade
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function put(PutTransfer $putTransfer): bool
    {
        $this->clientStorageFacade->put($putTransfer);

        return true;
    }
}