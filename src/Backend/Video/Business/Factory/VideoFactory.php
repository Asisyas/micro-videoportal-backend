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
use App\Shared\Video\Exception\VideoNotFoundException;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

/**
 * TODO: Expand update/create transfers as composition class
 * TODO: PoC solution for fast implementation
 */
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
    public function update(VideoTransfer $videoTransfer): VideoTransfer
    {
        $videoId = $videoTransfer->getId();
        if(!$videoId) {
            throw new VideoNotFoundException('Video can not be loaded.');
        }

        $em = $this->doctrineFacade->getManager();
        $repository = $em->getRepository(Video::class);
        /** @var Video $videoEntity */
        $videoEntity =  $repository->findOneBy(['id' => $videoTransfer->getId()]);
        if(!$videoEntity) {
            throw new VideoNotFoundException(sprintf('Video with id %s not found', $videoTransfer->getId()));
        }

        $videoEntity->setTitle($videoTransfer->getName());

        $media = $videoTransfer->getMedia();
        if($media) {
            $videoEntity->setMediaSrc($media->getSrc());
        }

        $em->beginTransaction();
        try {
            $em->persist($videoEntity);
            $em->flush();

            $this->updateClientStorage($videoTransfer);

            $em->commit();
        } catch (\Throwable $exception) {
            $em->rollback();

            throw $exception;
        }

        return $videoTransfer;
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

            $this->updateClientStorage($videoTransfer);

            $em->commit();

        } catch (\Throwable $exception) {
            $em->rollback();

            throw $exception;
        }

        return $videoTransfer;
    }

    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return void
     */
    protected function updateClientStorage(VideoTransfer $videoTransfer): void
    {
        $videoId    = $videoTransfer->getId();
        $put        = new PutTransfer();

        $put->setUuid($videoId);
        $put->setIndex(Configuration::STORAGE_INDEX_KEY);
        $put->setData($videoTransfer);

        $this->clientStorageFacade->put($put);
    }
}