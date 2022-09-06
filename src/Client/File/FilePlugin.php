<?php

namespace App\Client\File;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\File\Client\FileClient;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Library\DTO\SerializerFacadeInterface;

class FilePlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(FileClientInterface::class, function (
            AmqpClientInterface $amqpClient,
            ClientReaderFacadeInterface $clientReaderFacade,
            SerializerFacadeInterface $serializerFacade
        ) {
            return $this->createClient(
                $amqpClient,
                $clientReaderFacade,
                $serializerFacade
            );
        });
    }

    /**
     * @param AmqpClientInterface $amqpClient
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param SerializerFacadeInterface $serializerFacade
     *
     * @return FileClientInterface
     */
    protected function createClient(
        AmqpClientInterface $amqpClient,
        ClientReaderFacadeInterface $clientReaderFacade,
        SerializerFacadeInterface $serializerFacade
    ): FileClientInterface
    {
        return new FileClient(
            $amqpClient,
            $clientReaderFacade,
            $serializerFacade
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