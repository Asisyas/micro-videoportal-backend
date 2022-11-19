<?php

namespace App\Backend\Video\Business\Manager;

use App\Backend\Video\Entity\Video;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @TODO: VideoTransfer expander
 */
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
        $videoId        = $videoSrcSetTransfer->getVideoId();
        $videoEntity    = $this->lookupVideoEntity($videoId);

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

    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     *
     * @throws VideoNotFoundException
     */
    public function lookup(VideoGetTransfer $videoGetTransfer): VideoTransfer
    {
        $videoEntity = $this->lookupVideoEntity($videoGetTransfer->getVideoId());

        return (new VideoTransfer())
            ->setId($videoEntity->getId())
            ->setSrc($videoEntity->getSrc())
            ->setCreatedAt($videoEntity->getCreatedAt())
            ;
    }

    /**
     * @param string $videoId
     *
     * @return Video
     *
     * @throws VideoNotFoundException
     */
    protected function lookupVideoEntity(string $videoId): Video
    {
        /** @var Video $videoEntity */
        $videoEntity = $this->entityManager->getRepository(Video::class)->findOneBy([
            'id'    => $videoId,
        ]);

        if(!$videoEntity) {
            throw new VideoNotFoundException(sprintf('No video found with id "%s"', $videoId));
        }

        return $videoEntity;
    }
}