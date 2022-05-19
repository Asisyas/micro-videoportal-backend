<?php

namespace App\Backend\ClientStorage\Facade;

use App\Backend\ClientStorage\Business\Client\ClientFactoryInterface;
use App\Shared\Generated\DTO\ClientStorage\DeleteTransfer;
use App\Shared\Generated\DTO\ClientStorage\PostTransfer;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;

class ClientStorageFacade implements ClientStorageFacadeInterface
{
    /**
     * @param ClientFactoryInterface $clientFactory
     */
    public function __construct(private readonly ClientFactoryInterface $clientFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function put(PutTransfer $putTransfer): void
    {
        $this->clientFactory->create()->put($putTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function post(PostTransfer $postTransfer): void
    {
        $this->clientFactory->create()->post($postTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(DeleteTransfer $deleteTransfer): void
    {
        $this->clientFactory->create()->delete($deleteTransfer);
    }
}