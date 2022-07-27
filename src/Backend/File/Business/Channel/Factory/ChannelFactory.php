<?php

namespace App\Backend\File\Business\Channel\Factory;

use App\Backend\File\Business\Channel\Expander\CredentialsResponse\CredentialsResponseExpanderFactoryInterface;
use App\Backend\File\Entity\Channel;
use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;
use App\Shared\Generated\DTO\File\CredentialsResponseTransfer;
use Doctrine\ORM\EntityManagerInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

/**
 * TODO: Create Channel expander
 */
class ChannelFactory implements ChannelFactoryInterface
{
    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param CredentialsResponseExpanderFactoryInterface $credentialsResponseExpanderFactory
     */
    public function __construct(
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly DoctrineFacadeInterface $doctrineFacade,
        private readonly CredentialsResponseExpanderFactoryInterface $credentialsResponseExpanderFactory
    )
    {
    }

    /**
     * @param CredentialsRequestTransfer $requestTransfer
     * @return CredentialsResponseTransfer
     */
    public function create(CredentialsRequestTransfer $requestTransfer): CredentialsResponseTransfer
    {
        $entityManager = $this->lookupEntityManager();

        $channel = new Channel($this->uuidFacade->v4());

        $channel->setSize($requestTransfer->getSize());
        $channel->setChunkSize(100);
        $channel->setChunkCount(10);
        $channel->setFileName($requestTransfer->getName());

        $entityManager->persist($channel);
        $entityManager->flush();

        $credentialsResponse = new CredentialsResponseTransfer();

        $this->credentialsResponseExpanderFactory
            ->create($channel)
            ->expand($credentialsResponse)
        ;

        return $credentialsResponse;
    }

    /**
     * @return EntityManagerInterface
     */
    protected function lookupEntityManager(): EntityManagerInterface
    {
        return $this->doctrineFacade->getManager();
    }
}