<?php

namespace App\Client\File;

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
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class FilePlugin extends AbstractPlugin
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
        $container->register(FileClientInterface::class, function (
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
     * @return FileClientInterface
     */
    protected function createClient(): FileClientInterface
    {
        return new FileClient(
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
}
