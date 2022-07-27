<?php

namespace App\Client\User;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\User\Client\UserClient;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class UserClientPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(UserClientInterface::class, function (AmqpClientInterface $amqpClient) {
            return $this->createClient($amqpClient);
        });
    }

    /**
     * @param AmqpClientInterface $amqpClient
     *
     * @return UserClient
     */
    public function createClient(AmqpClientInterface $amqpClient)
    {
        return new UserClient($amqpClient);
    }
}