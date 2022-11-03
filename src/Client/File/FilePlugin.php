<?php

namespace App\Client\File;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\File\Client\FileClient;
use App\Client\File\Expander\File\FileTransferExpanderFactory;
use App\Client\File\Expander\File\FileTransferExpanderFactoryInterface;
use App\Client\File\Reader\FileClientReaderFactory;
use App\Client\File\Reader\FileClientReaderFactoryInterface;
use App\Client\File\Store\FileClientStoreFactory;
use App\Client\File\Store\FileClientStoreFactoryInterface;
use App\Client\File\Uploader\FileUploaderFactoryInterface;
use App\Client\File\Uploader\Local\FileUploaderFactory;
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
            $fileStoreClientFactory = $this->createFileClientStoreFactory($amqpClient);
            $fileClientReaderFactory = $this->createFileClientReaderFactory($clientReaderFacade, $serializerFacade);
            $fileUploaderFactory = $this->createFileUploaderFactory($fileClientReaderFactory);

            return $this->createClient(
                $fileStoreClientFactory,
                $fileClientReaderFactory,
                $fileUploaderFactory
            );
        });
    }

    /**
     * @return FileTransferExpanderFactoryInterface
     */
    protected function createFileTransferExpanderFactory(): FileTransferExpanderFactoryInterface
    {
        return new FileTransferExpanderFactory();
    }

    /**
     * @param AmqpClientInterface $amqpClient
     *
     * @return FileClientStoreFactoryInterface
     */
    protected function createFileClientStoreFactory(AmqpClientInterface $amqpClient): FileClientStoreFactoryInterface
    {
        return new FileClientStoreFactory($amqpClient);
    }

    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param SerializerFacadeInterface $serializerFacade
     *
     * @return FileClientReaderFactoryInterface
     */
    protected function createFileClientReaderFactory(
        ClientReaderFacadeInterface $clientReaderFacade,
        SerializerFacadeInterface $serializerFacade
    ): FileClientReaderFactoryInterface
    {
        return new FileClientReaderFactory(
            $clientReaderFacade,
            $serializerFacade,
            $this->createFileTransferExpanderFactory()
        );
    }

    /**
     * @param FileClientReaderFactoryInterface $fileClientReaderFactory
     *
     * @return FileUploaderFactoryInterface
     */
    protected function createFileUploaderFactory(FileClientReaderFactoryInterface $fileClientReaderFactory): FileUploaderFactoryInterface
    {
        return new FileUploaderFactory(
            $fileClientReaderFactory
        );
    }

    /**
     * @param FileClientStoreFactoryInterface $fileClientStoreFactory
     * @param FileClientReaderFactoryInterface $fileClientReaderFactory
     * @param FileUploaderFactoryInterface $fileUploaderFactory
     * @return FileClientInterface
     */
    protected function createClient(
        FileClientStoreFactoryInterface $fileClientStoreFactory,
        FileClientReaderFactoryInterface $fileClientReaderFactory,
        FileUploaderFactoryInterface $fileUploaderFactory
    ): FileClientInterface
    {
        return new FileClient(
            $fileClientStoreFactory,
            $fileClientReaderFactory,
            $fileUploaderFactory
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