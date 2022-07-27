<?php

namespace App\Backend\User\Business\Factory;

use App\Backend\User\Entity\User;
use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\Generated\DTO\User\UserTransfer;
use Micro\Plugin\User\Facade\UserManagerFacadeInterface;
use Micro\Plugin\User\Model\UserInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class UserFactory implements UserFactoryInterface
{
    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param UserManagerFacadeInterface $userManagerFacade
     */
    public function __construct(
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly UserManagerFacadeInterface $userManagerFacade
    )
    {
    }

    public function create(UserCreateTransfer $userCreateTransfer): UserTransfer
    {
        $user = new User(
            $this->uuidFacade->v4(),
            $userCreateTransfer->getUsername(),
            $userCreateTransfer->getRoles()
        );

        $this->userManagerFacade->createUser($user);

        return $this->createUserTransfer($user);
    }

    /**
     * @param UserInterface $user
     *
     * @return UserTransfer
     */
    protected function createUserTransfer(UserInterface $user): UserTransfer
    {
        $userTransfer = new UserTransfer();

        return $userTransfer
            ->setUsername($user->getName())
            ->setUuid($user->getId())
            ->setRoles($user->getRoles());
    }
}