<?php

namespace App\Frontend\VideoWatch\Factory;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoGetTransferFactory implements VideoGetTransferFactoryInterface
{
    /**
     * @param Request $request
     *
     * @return VideoGetTransfer
     */
    public function create(Request $request): VideoGetTransfer
    {
        $videoGetTransfer = new VideoGetTransfer();
        $videoGetTransfer->setVideoId($request->get('id'));

        return $videoGetTransfer;
    }
}