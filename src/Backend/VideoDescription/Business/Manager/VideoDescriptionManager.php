<?php

namespace App\Backend\VideoDescription\Business\Manager;

use App\Backend\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderInterface;
use App\Backend\VideoDescription\Business\Factory\Entity\VideoDescriptionEntityFactoryInterface;
use App\Backend\VideoDescription\Business\Factory\Transfer\VideoDescriptionTransferFactoryInterface;
use App\Backend\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionGetTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use Doctrine\ORM\EntityManagerInterface;

class VideoDescriptionManager implements VideoDescriptionManagerInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param VideoDescriptionEntityFactoryInterface $videoDescriptionEntityFactory
     * @param VideoDescriptionTransferFactoryInterface $videoDescriptionTransferFactory
     * @param VideoDescriptionEntityExpanderInterface $videoDescriptionEntityExpander
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly VideoDescriptionEntityFactoryInterface $videoDescriptionEntityFactory,
        private readonly VideoDescriptionTransferFactoryInterface $videoDescriptionTransferFactory,
        private readonly VideoDescriptionEntityExpanderInterface $videoDescriptionEntityExpander
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(VideoDescriptionGetTransfer $videoDescriptionGetTransfer): VideoDescriptionTransfer
    {
        $videoId = $videoDescriptionGetTransfer->getVideoId();
        $videoDescription = $this->lookupEntity($videoId);

        return $this->videoDescriptionTransferFactory->create($videoDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function update(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool
    {
        $videoDescription = $this->lookupEntity($videoDescriptionPutTransfer->getVideoId());

        $this->videoDescriptionEntityExpander->expand(
            $videoDescription,
            $videoDescriptionPutTransfer->getSource()
        );

        $this->entityManager->persist($videoDescription);
        $this->entityManager->flush();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool
    {
        $this->entityManager->persist(
            $this->videoDescriptionEntityFactory->create($videoDescriptionPutTransfer)
        );

        $this->entityManager->flush();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer): bool
    {
        $videoDescription = $this->lookupEntity($videoDescriptionDeleteTransfer->getVideoId());
        $this->entityManager->remove($videoDescription);
        $this->entityManager->flush();

        return true;
    }

    /**
     * @param string $id
     *
     * @return VideoDescription
     */
    protected function lookupEntity(string $id): VideoDescription
    {
        return $this->entityManager
            ->getRepository(VideoDescription::class)
            ->findOneBy(['id' => $id]);
    }
}
