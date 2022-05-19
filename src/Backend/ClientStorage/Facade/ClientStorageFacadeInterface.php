<?php

namespace App\Backend\ClientStorage\Facade;

use App\Shared\Generated\DTO\ClientStorage\DeleteTransfer;
use App\Shared\Generated\DTO\ClientStorage\PostTransfer;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;

interface ClientStorageFacadeInterface
{
    /**
     * @param PutTransfer $putTransfer
     *
     * @return void
     */
    public function put(PutTransfer $putTransfer): void;

    /**
     * @param PostTransfer $postTransfer
     *
     * @return void
     */
    public function post(PostTransfer $postTransfer): void;

    /**
     * @param DeleteTransfer $deleteTransfer
     *
     * @return void
     */
    public function delete(DeleteTransfer $deleteTransfer): void;
}