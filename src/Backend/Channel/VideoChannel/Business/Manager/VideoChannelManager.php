<?php

namespace App\Backend\Channel\VideoChannel\Business\Manager;

use App\Backend\Channel\VideoChannel\Business\Expander\Entity\VideoChannelEntityExpanderFactoryInterface;
use App\Backend\Channel\VideoChannel\Business\Expander\Transfer\VideoChannelTransferExpanderFactoryInterface;
use App\Backend\Channel\VideoChannel\Entity\VideoChannel;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Exception\ChannelIdAlreadyExistsException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;

class VideoChannelManager implements VideoChannelManagerInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param VideoChannelEntityExpanderFactoryInterface $channelEntityExpanderFactory
     * @param VideoChannelTransferExpanderFactoryInterface $channelTransferExpanderFactory
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly VideoChannelEntityExpanderFactoryInterface $channelEntityExpanderFactory,
        private readonly VideoChannelTransferExpanderFactoryInterface $channelTransferExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function lookupChannel(VideoChannelGetTransfer $videoChannelGetTransfer): VideoChannelTransfer
    {
        $videoChannelTransfer = new VideoChannelTransfer();

        $videoChannelTransfer->setId($videoChannelGetTransfer->getChannelId());
        $this->channelTransferExpanderFactory
            ->create()
            ->expand($videoChannelTransfer);

        return $videoChannelTransfer;
    }

    /**
     * {@inheritDoc}
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): void
    {
        $channel = new VideoChannel(
            $videoChannelCreateTransfer->getId(),
            $videoChannelCreateTransfer->getOwnerId(),
            $videoChannelCreateTransfer->getTitle()
        );

        $this->channelEntityExpanderFactory
            ->create()
            ->expand($channel, $videoChannelCreateTransfer);

        try {
            $this->entityManager->persist($channel);
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $exception) {
            throw new ChannelIdAlreadyExistsException(
                sprintf('Channel with id "%s" already exists.', $videoChannelCreateTransfer->getId()),
                0,
                $exception
            );
        }
    }
}
