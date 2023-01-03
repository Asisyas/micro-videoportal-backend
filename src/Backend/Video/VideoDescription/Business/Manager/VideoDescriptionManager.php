<?php

namespace App\Backend\Video\VideoDescription\Business\Manager;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\Video\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderInterface;
use App\Backend\Video\VideoDescription\Business\Factory\Entity\VideoDescriptionEntityFactoryInterface;
use App\Backend\Video\VideoDescription\Business\Factory\Transfer\VideoDescriptionTransferFactoryInterface;
use App\Backend\Video\VideoDescription\Entity\VideoDescription;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionGetTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\VideoDescription\Constants;
use Doctrine\ORM\EntityManagerInterface;

class VideoDescriptionManager implements VideoDescriptionManagerInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param VideoDescriptionEntityFactoryInterface $videoDescriptionEntityFactory
     * @param VideoDescriptionTransferFactoryInterface $videoDescriptionTransferFactory
     * @param VideoDescriptionEntityExpanderInterface $videoDescriptionEntityExpander
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly VideoDescriptionEntityFactoryInterface $videoDescriptionEntityFactory,
        private readonly VideoDescriptionTransferFactoryInterface $videoDescriptionTransferFactory,
        private readonly VideoDescriptionEntityExpanderInterface $videoDescriptionEntityExpander,
        private readonly ClientStorageFacadeInterface $clientStorageFacade
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

        $this->propagateStorage($videoDescription);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool
    {
        $videoDescriptionEntity = $this->videoDescriptionEntityFactory->create($videoDescriptionPutTransfer);
        $this->entityManager->persist($videoDescriptionEntity);

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

    public function propagate(VideoGetTransfer $videoGetTransfer): void
    {
        $videoDescriptionEntity = $this->lookupEntity($videoGetTransfer->getVideoId());

        $this->propagateStorage($videoDescriptionEntity);
    }

    /**
     * @param VideoDescription $videoDescriptionEntity
     *
     * @return void
     */
    protected function propagateStorage(VideoDescription $videoDescriptionEntity): void
    {
        $putTransfer = new PutTransfer();
        $putTransfer
            ->setIndex(Constants::STORAGE_IDX)
            ->setUuid($videoDescriptionEntity->getId())
            ->setData($this->videoDescriptionTransferFactory->create($videoDescriptionEntity));

        $this->clientStorageFacade->put($putTransfer);
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
