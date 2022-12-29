<?php

namespace App\Backend\File;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\File\Business\File\Factory\FileFactory;
use App\Backend\File\Business\File\Factory\FileFactoryInterface;
use App\Backend\File\Business\File\Manager\FileManagerFactory;
use App\Backend\File\Business\File\Manager\FileManagerFactoryInterface;
use App\Backend\File\Business\File\Storage\FileStorageFactory;
use App\Backend\File\Business\File\Storage\FileStorageFactoryInterface;
use App\Backend\File\Configuration\FilePluginConfigurationInterface;
use App\Backend\File\Facade\FileFacade;
use App\Backend\File\Facade\FileFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

/**
 * @method FilePluginConfigurationInterface configuration()
 */
class FilePlugin implements DependencyProviderInterface, ConfigurableInterface
{
    use PluginConfigurationTrait;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(FileFacadeInterface::class, function (
            UuidFacadeInterface $uuidFacade,
            DoctrineFacadeInterface $doctrineFacade,
            ClientStorageFacadeInterface $clientStorageFacade,
            FilesystemFacadeInterface $filesystemFacade
        ) {
            return $this->createFacade(
                $uuidFacade,
                $doctrineFacade,
                $clientStorageFacade,
                $filesystemFacade
            );
        });
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param ClientStorageFacadeInterface $clientStorageFacade
     * @param FilesystemFacadeInterface $filesystemFacade
     *
     * @return FileFacadeInterface
     */
    protected function createFacade(
        UuidFacadeInterface $uuidFacade,
        DoctrineFacadeInterface $doctrineFacade,
        ClientStorageFacadeInterface $clientStorageFacade,
        FilesystemFacadeInterface $filesystemFacade
    ): FileFacadeInterface {
        $fileStorageFactory = $this->createFileStorageFactory($clientStorageFacade);

        $fileFactory = $this->createFileFactory(
            $uuidFacade,
            $doctrineFacade,
            $fileStorageFactory
        );

        $fileManagerFactory = $this->createFileManagerFactory(
            $doctrineFacade,
            $fileFactory,
            $fileStorageFactory,
            $filesystemFacade,
        );

        return new FileFacade($fileManagerFactory);
    }

    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     *
     * @return FileStorageFactoryInterface
     */
    protected function createFileStorageFactory(ClientStorageFacadeInterface $clientStorageFacade): FileStorageFactoryInterface
    {
        return new FileStorageFactory($clientStorageFacade);
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param FileStorageFactoryInterface $fileStorageFactory
     *
     * @return FileFactoryInterface
     */
    protected function createFileFactory(
        UuidFacadeInterface $uuidFacade,
        DoctrineFacadeInterface $doctrineFacade,
        FileStorageFactoryInterface $fileStorageFactory
    ): FileFactoryInterface {
        return new FileFactory(
            $uuidFacade,
            $doctrineFacade,
            $fileStorageFactory
        );
    }

    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param FileFactoryInterface $fileFactory
     * @param FileStorageFactoryInterface $fileStorageFactory
     * @param FilesystemFacadeInterface $filesystemFacade
     *
     * @return FileManagerFactoryInterface
     */
    protected function createFileManagerFactory(
        DoctrineFacadeInterface $doctrineFacade,
        FileFactoryInterface $fileFactory,
        FileStorageFactoryInterface $fileStorageFactory,
        FilesystemFacadeInterface $filesystemFacade
    ): FileManagerFactoryInterface {
        return new FileManagerFactory(
            $doctrineFacade,
            $fileFactory,
            $fileStorageFactory,
            $filesystemFacade
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginBackend';
    }
}
