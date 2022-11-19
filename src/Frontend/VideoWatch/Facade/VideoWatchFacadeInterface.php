<?php

namespace App\Frontend\VideoWatch\Facade;

use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

interface VideoWatchFacadeInterface
{
    /**
     * @param Request $request
     *
     * @return VideoWatchTransfer
     *
     * @throws NotFoundHttpException
     */
    public function handleVideoWatchRequest(Request $request): VideoWatchTransfer;
}