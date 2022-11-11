<?php

namespace App\Frontend\VideoPublish\Facade;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface VideoPublishFacadeInterface
{
    /**
     * @param Request $request
     *
     * @return VideoPublishTransfer
     */
    public function createVideoPublishTransferFromRequest(Request $request): VideoPublishTransfer;

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handleVideoPublishRequest(Request $request): Response;
}