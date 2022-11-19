<?php

namespace App\Frontend\VideoWatch\Facade;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Client\Video\Client\VideoClientInterface;
use App\Frontend\VideoWatch\Factory\VideoGetTransferFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class VideoWatchFacade implements VideoWatchFacadeInterface
{
    public function __construct(
    )
    {

    }

    /**
     * @param Request $request
     *
     * @return VideoWatchTransfer
     */
    public function getVideoFromRequest(Request $request): VideoWatchTransfer
    {
        //$publicUrl = $this->filesystemFacade->createFsOperator()->publicUrl($media->getSrc());

        return new VideoWatchTransfer();
    }
}