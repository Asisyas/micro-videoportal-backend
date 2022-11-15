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
use App\Client\File\Uploader\FileUploaderFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

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
            FilesystemFacadeInterface $filesystemFacade

        ) {
            $fileStoreClientFactory = $this->createFileClientStoreFactory($amqpClient);
            $fileClientReaderFactory = $this->createFileClientReaderFactory($clientReaderFacade);
            $fileUploaderFactory = $this->createFileUploaderFactory($fileStoreClientFactory, $filesystemFacade);

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
     *
     * @return FileClientReaderFactoryInterface
     */
    protected function createFileClientReaderFactory(
        ClientReaderFacadeInterface $clientReaderFacade
    ): FileClientReaderFactoryInterface
    {
        return new FileClientReaderFactory(
            $clientReaderFacade,
            $this->createFileTransferExpanderFactory()
        );
    }

    /**
     * @param FileClientStoreFactoryInterface $fileClientStoreFactory
     * @param FilesystemFacadeInterface $filesystemFacade
     *
     * @return FileUploaderFactoryInterface
     */
    protected function createFileUploaderFactory(
        FileClientStoreFactoryInterface $fileClientStoreFactory,
        FilesystemFacadeInterface $filesystemFacade
    ): FileUploaderFactoryInterface
    {
        return new FileUploaderFactory(
            $fileClientStoreFactory,
            $filesystemFacade
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