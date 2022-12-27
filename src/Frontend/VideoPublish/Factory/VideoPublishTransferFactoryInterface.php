<?php

namespace App\Frontend\VideoPublish\Factory;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Symfony\Component\HttpFoundation\Request;

interface VideoPublishTransferFactoryInterface
{
    /**
     * @param Request $request
     *
     * @return VideoPublishTransfer
     *
     * @throws HttpBadRequestException
     */
    public function createFromRequest(Request $request): VideoPublishTransfer;
}
