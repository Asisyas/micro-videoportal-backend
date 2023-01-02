<?php

namespace App\Backend\Video\Video\Business\Manager;

use App\Backend\Video\Video\Entity\Video;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
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
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): void
    {
        $videoId        = $videoSrcSetTransfer->getVideoId();
        $videoEntity    = $this->lookupVideoEntity($videoId);

        $videoEntity->setSrc($videoSrcSetTransfer->getSrc());
        $this->entityManager->persist($videoEntity);
        $this->entityManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoPublishTransfer $videoPublishTransfer): VideoTransfer
    {
        $videoID        = $videoPublishTransfer->getFileId();
        $channelId      = $videoPublishTransfer->getChannelId();
        $videoTransfer  = new VideoTransfer();
        $videoEntity    = new Video($videoID, $channelId);

        $videoTransfer
            ->setId($videoID)
            ->setChannelId($channelId)
        ;

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
            ->setChannelId($videoEntity->getChannelId())
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
        /** @var Video|null $videoEntity */
        $videoEntity = $this->entityManager->getRepository(Video::class)->findOneBy([
            'id'    => $videoId,
        ]);

        if (!$videoEntity) {
            throw new VideoNotFoundException(sprintf('No video found with id "%s"', $videoId));
        }

        return $videoEntity;
    }
}
