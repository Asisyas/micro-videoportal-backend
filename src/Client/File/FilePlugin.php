<?php

namespace App\Client\File;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\File\Client\FileClientFacade;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Redis\RedisFacadeInterface;

class FilePlugin extends AbstractPlugin
{
    public function provideDependencies(Container $container): void
    {
        $container->register(FileClientInterface::class, function (AmqpClientInterface $amqpClient, RedisFacadeInterface $redisFacade) {
            return $this->createClient(
                $amqpClient,
                $redisFacade
            );
        });
    }

    protected function createClient(AmqpClientInterface $amqpClient, RedisFacadeInterface $redisFacade): FileClientInterface
    {
        return new FileClientFacade(
            $amqpClient,
            $redisFacade->getClient()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginClient';
    }
}