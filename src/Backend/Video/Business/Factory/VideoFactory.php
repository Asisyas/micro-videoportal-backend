<?php

namespace App\Backend\Video\Business\Factory;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\Video\Entity\Video;
use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Configuration;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class VideoFactory implements VideoFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param ClientStorageFacadeInterface $clientStorageFacade
     * @param FileClientInterface $fileClient
     */
    public function __construct(
        private readonly DoctrineFacadeInterface $doctrineFacade,
        private readonly ClientStorageFacadeInterface $clientStorageFacade,
        private readonly FileClientInterface $fileClient
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        $fileGetTransfer = new FileGetTransfer();
        $fileGetTransfer->setId($videoCreateTransfer->getFileId());
        $fileTransfer = $this->fileClient->lookupFile($fileGetTransfer);
        $videoTransfer = new VideoTransfer();
        $videoId = $videoCreateTransfer->getFileId();
        $videoTitle = $fileTransfer->getName();
        $videoTransfer->setId($videoId);
        $videoTransfer->setName($videoTitle);

        $em = $this->doctrineFacade->getManager();
        $videoEntity = new Video($videoId, $videoTitle);
        $videoTransfer->setCreatedAt($videoEntity->getCreatedAt());

        try {
            $em->beginTransaction();
            $em->persist($videoEntity);
            $em->flush();

            $put = new PutTransfer();
            $put->setUuid($videoId);
            $put->setIndex(Configuration::STORAGE_INDEX_KEY);
            $put->setData($videoTransfer);

            $this->clientStorageFacade->put($put);

            $em->commit();

        } catch (\Throwable $exception) {
            $em->rollback();

            throw $exception;
        }

        return $videoTransfer;
    }
}