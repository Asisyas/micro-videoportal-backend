<?php

namespace App\Frontend\VideoWatch\Facade;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTRansfer;
use App\Shared\Video\Configuration;
use Carbon\Carbon;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class VideoWatchFacade implements VideoWatchFacadeInterface
{
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly FilesystemFacadeInterface $filesystemFacade
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function handleVideoWatchRequest(Request $request): VideoWatchTransfer
    {
        $videoId = $request->get('id');
        try {
            /** @var VideoWatchTransfer $videoWatchTransfer */
            $videoWatchTransfer = $this->clientReaderFacade->lookup(
                (new RequestTransfer())
                    ->setIndex(Configuration::STORAGE_INDEX_KEY)
                    ->setUuid($videoId)
            )->getData();
        } catch (NotFoundException $exception) {
            throw new HttpNotFoundException();
        }

        $src = $videoWatchTransfer->getSrc();
        if($src) {
            $fs = $this->filesystemFacade->createFsOperator();
            $videoWatchTransfer->setSrc(
                $fs->temporaryUrl(
                    $src,
                    (new \DateTime('now'))->modify('+30 seconds')
                ),
            );
        }


        return $videoWatchTransfer;
    }
}