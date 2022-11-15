<?php

namespace App\Frontend\VideoWatch\Facade;

use App\Shared\Generated\DTO\Video\VideoTransfer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

interface VideoWatchFacadeInterface
{
    /**
     * @param Request $request
     *
     * @return VideoTransfer
     *
     * @throws NotFoundHttpException
     */
    public function getVideoFromRequest(Request $request): VideoTransfer;
}