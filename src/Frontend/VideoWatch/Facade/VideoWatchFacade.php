<?php

namespace App\Frontend\VideoWatch\Facade;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Client\Video\Client\VideoClientInterface;
use App\Frontend\VideoWatch\Factory\VideoGetTransferFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class VideoWatchFacade implements VideoWatchFacadeInterface
{
    public function __construct(
        private readonly VideoClientInterface $videoClient,
        private readonly VideoGetTransferFactoryInterface $videoGetTransferFactory,
        private readonly FilesystemFacadeInterface $filesystemFacade
    )
    {

    }

    /**
     * @param Request $request
     *
     * @return VideoTransfer
     */
    public function getVideoFromRequest(Request $request): VideoTransfer
    {
        $videoGet = $this->videoGetTransferFactory->create($request);
        $videoTransfer = $this->getVideo($videoGet);

        if($videoTransfer->getMedia() !== null) {
            $media = $videoTransfer->getMedia();
            $publicUrl = $this->filesystemFacade->createFsOperator()->publicUrl($media->getSrc());
            $media->setSrc($publicUrl);
        }

        return $videoTransfer;
    }

    /**
     * @param VideoGetTransfer $videoGetTransfer
     * @return VideoTransfer
     *
     * @throws HttpNotFoundException
     */
    protected function getVideo(VideoGetTransfer $videoGetTransfer): VideoTransfer
    {
        try {
            return $this->videoClient->lookupVideo($videoGetTransfer);
        } catch (NotFoundException $exception) {
            throw new HttpNotFoundException();
        }
    }
}