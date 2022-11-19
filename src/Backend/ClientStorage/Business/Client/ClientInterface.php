<?php

namespace App\Backend\ClientStorage\Business\Client;

use App\Shared\Generated\DTO\ClientStorage\DeleteTransfer;
use App\Shared\Generated\DTO\ClientStorage\PostTransfer;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;

interface ClientInterface
{
    /**
     * @param PutTransfer $putTransfer
     *
     * @return void
     */
    public function put(PutTransfer $putTransfer): void;

    /**
     * @deprecated
     *
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