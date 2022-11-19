<?php

namespace App\Frontend\VideoWatch\Controller;

use App\Frontend\VideoWatch\Facade\VideoWatchFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoWatchController
{
    /**
     * @param VideoWatchFacadeInterface $videoWatchFacade
     */
    public function __construct(
        private readonly VideoWatchFacadeInterface $videoWatchFacade
    )
    {
    }

    /**
     * @param Request $request
     *
     * @return VideoWatchTransfer
     */
    public function getVideo(Request $request): VideoWatchTransfer
    {
        return $this->videoWatchFacade->handleVideoWatchRequest($request);
    }
}