<?php

namespace App\Frontend\VideoChannel\Handler;

use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Symfony\Component\HttpFoundation\Request;

interface ChannelCreateRequestHandlerInterface
{

    /**
     * @param Request $request
     *
     * @return VideoChannelTransfer
     */
    public function handleChannelCreateFromRequest(Request $request): VideoChannelTransfer;
}