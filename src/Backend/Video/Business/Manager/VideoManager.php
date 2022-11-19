<?php

namespace App\Backend\Video\Business\Manager;

use App\Backend\Video\Entity\Video;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class VideoManager implements VideoManagerInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): void
    {
        $videoId = $videoSrcSetTransfer->getVideoId();

        /** @var Video $videoEntity */
        $videoEntity = $this->entityManager->getRepository(Video::class)->findOneBy([
            'id'    => $videoId,
        ]);

        if(!$videoEntity) {
            throw new VideoNotFoundException(sprintf('No video found with id "%s"', $videoId));
        }

        $videoEntity->setSrc($videoSrcSetTransfer->getSrc());
        $this->entityManager->persist($videoEntity);
        $this->entityManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        $videoID        = $videoCreateTransfer->getVideoId();
        $videoTransfer  = new VideoTransfer();
        $videoEntity    = new Video($videoID);

        $videoTransfer->setId($videoID);

        $this->entityManager->persist($videoEntity);
        $this->entityManager->flush();

        return $videoTransfer;
    }
}