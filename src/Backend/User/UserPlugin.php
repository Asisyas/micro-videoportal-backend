<?php

namespace App\Backend\User;

use App\Backend\User\Business\Factory\UserFactory;
use App\Backend\User\Business\Factory\UserFactoryInterface;
use App\Backend\User\Business\Manager\UserManagerFactory;
use App\Backend\User\Business\Manager\UserManagerFactoryInterface;
use App\Backend\User\Consumer\UserCreateConsumer;
use App\Backend\User\Facade\UserFacade;
use App\Backend\User\Facade\UserFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerProcessorInterface;
use Micro\Plugin\User\Facade\UserManagerFacadeInterface;
use Micro\Plugin\User\UserPlugin as UserCorePlugin;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class UserPlugin extends UserCorePlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(UserFacadeInterface::class, function (
            UuidFacadeInterface $uuidFacade,
            UserManagerFacadeInterface $userManagerFacade
        ) {
            return $this->createFacade($uuidFacade, $userManagerFacade);
        });
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param UserManagerFacadeInterface $userManagerFacade
     *
     * @return UserFacadeInterface
     */
    protected function createFacade(UuidFacadeInterface $uuidFacade, UserManagerFacadeInterface $userManagerFacade): UserFacadeInterface
    {
        $userFactory = $this->createUserFactory($uuidFacade, $userManagerFacade);
        $appUserManager = $this->createUserManagerFactory($userFactory);

        return new UserFacade($appUserManager);
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param UserManagerFacadeInterface $userManagerFacade
     *
     * @return UserFactoryInterface
     */
    protected function createUserFactory(UuidFacadeInterface $uuidFacade, UserManagerFacadeInterface $userManagerFacade): UserFactoryInterface
    {
        return new UserFactory(
            $uuidFacade,
            $userManagerFacade
        );
    }

    /**
     * @param UserFactoryInterface $userFactory
     *
     * @return UserManagerFactoryInterface
     */
    protected function createUserManagerFactory(UserFactoryInterface $userFactory): UserManagerFactoryInterface
    {
        return new UserManagerFactory($userFactory);
    }
}