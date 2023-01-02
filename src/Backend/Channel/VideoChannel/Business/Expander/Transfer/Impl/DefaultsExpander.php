<?php

namespace App\Backend\Channel\VideoChannel\Business\Expander\Transfer\Impl;

use App\Backend\Channel\VideoChannel\Business\Expander\Transfer\VideoChannelTransferExpanderInterface;
use App\Backend\Channel\VideoChannel\Entity\VideoChannel;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Doctrine\ORM\EntityManagerInterface;

class DefaultsExpander implements VideoChannelTransferExpanderInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function expand(VideoChannelTransfer $videoChannelTransfer): void
    {
        /** @var VideoChannel $channel */
        $channel = $this->entityManager->getRepository(VideoChannel::class)->findOneBy([
            'id'    => $videoChannelTransfer->getId()
        ]);

        $videoChannelTransfer
            ->setTitle($channel->getTitle())
            ->setCreatedAt($channel->getCreatedAt())
            ->setOwnerId($channel->getOwnerId())
        ;
    }
}
