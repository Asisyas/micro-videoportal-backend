<?php

namespace App\Frontend\VideoWatch\Controller;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Client\Video\Client\ClientVideoInterface;
use App\Frontend\VideoWatch\Facade\VideoWatchFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class VideoWatchController
{
    /**
     * @param ClientVideoInterface $clientVideo
     */
    public function __construct(
        private readonly ClientVideoInterface $clientVideo
    ) {
    }

    /**
     * @param Request $request
     *
     * @return VideoTransfer
     *
     * @throws HttpNotFoundException
     */
    public function getVideo(Request $request): VideoTransfer
    {
        try {
            $videoGetTransfer = new VideoGetTransfer();
            $videoGetTransfer->setVideoId($request->get('id'));

            return $this->clientVideo->lookupVideo($videoGetTransfer);
        } catch (NotFoundException $exception) {
            throw new HttpNotFoundException();
        }
    }
}
