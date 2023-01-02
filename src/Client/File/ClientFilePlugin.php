<?php

namespace App\Client\File;

use App\Client\ClientReader\ClientReaderPlugin;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\File\Client\ClientFile;
use App\Client\File\Client\ClientFileInterface;
use App\Client\File\Expander\File\FileTransferExpanderFactory;
use App\Client\File\Expander\File\FileTransferExpanderFactoryInterface;
use App\Client\File\Reader\FileClientReaderFactory;
use App\Client\File\Reader\FileClientReaderFactoryInterface;
use App\Client\File\Store\FileClientStoreFactory;
use App\Client\File\Store\FileClientStoreFactoryInterface;
use App\Client\File\Uploader\FileUploaderFactory;
use App\Client\File\Uploader\FileUploaderFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Filesystem\FilesystemPlugin;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Micro\Plugin\Temporal\TemporalPlugin;

class ClientFilePlugin implements DependencyProviderInterface, PluginDependedInterface
{
    /**
     * @var TemporalFacadeInterface
     */
    private readonly TemporalFacadeInterface            $temporalFacade;

    /**
     * @var ClientReaderFacadeInterface
     */
    private readonly ClientReaderFacadeInterface        $clientReaderFacade;

    /**
     * @var FilesystemFacadeInterface
     */
    private readonly FilesystemFacadeInterface          $filesystemFacade;

    /**
     * @var FileClientStoreFactoryInterface
     */
    private readonly FileClientStoreFactoryInterface    $fileClientStoreFactory;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ClientFileInterface::class, function (
            TemporalFacadeInterface $temporalFacade,
            ClientReaderFacadeInterface $clientReaderFacade,
            FilesystemFacadeInterface $filesystemFacade
        ) {
            $this->temporalFacade           = $temporalFacade;
            $this->clientReaderFacade       = $clientReaderFacade;
            $this->filesystemFacade         = $filesystemFacade;
            $this->fileClientStoreFactory   = $this->createFileClientStoreFactory();

            return $this->createClient();
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
     * @return FileClientStoreFactoryInterface
     */
    protected function createFileClientStoreFactory(): FileClientStoreFactoryInterface
    {
        return new FileClientStoreFactory(
            $this->temporalFacade
        );
    }

    /**
     * @return FileClientReaderFactoryInterface
     */
    protected function createFileClientReaderFactory(): FileClientReaderFactoryInterface
    {
        return new FileClientReaderFactory(
            $this->clientReaderFacade,
            $this->createFileTransferExpanderFactory()
        );
    }

    /**
     * @return FileUploaderFactoryInterface
     */
    protected function createFileUploaderFactory(): FileUploaderFactoryInterface
    {
        return new FileUploaderFactory(
            $this->fileClientStoreFactory,
            $this->filesystemFacade
        );
    }

    /**
     * @return ClientFileInterface
     */
    protected function createClient(): ClientFileInterface
    {
        return new ClientFile(
            $this->fileClientStoreFactory,
            $this->createFileClientReaderFactory(),
            $this->createFileUploaderFactory()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginClient';
    }

    public function getDependedPlugins(): iterable
    {
        return [
            FilesystemPlugin::class,
            TemporalPlugin::class,
            FilesystemPlugin::class,
            ClientReaderPlugin::class,
        ];
    }
}
