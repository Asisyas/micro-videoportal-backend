<?php

namespace App\Backend\File;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\File\Business\File\Factory\FileFactory;
use App\Backend\File\Business\File\Factory\FileFactoryInterface;
use App\Backend\File\Business\File\Storage\FileStorageFactory;
use App\Backend\File\Business\File\Storage\FileStorageFactoryInterface;
use App\Backend\File\Configuration\FilePluginConfigurationInterface;
use App\Backend\File\Facade\FileFacade;
use App\Backend\File\Facade\FileFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

/**
 * @method FilePluginConfigurationInterface configuration()
 */
class FilePlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(FileFacadeInterface::class, function (
            UuidFacadeInterface $uuidFacade,
            DoctrineFacadeInterface $doctrineFacade,
            ClientStorageFacadeInterface $clientStorageFacade
        ) {
            return $this->createFacade(
                $uuidFacade,
                $doctrineFacade,
                $clientStorageFacade
            );
        });
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param ClientStorageFacadeInterface $clientStorageFacade
     *
     * @return FileFacadeInterface
     */
    protected function createFacade(
        UuidFacadeInterface $uuidFacade,
        DoctrineFacadeInterface $doctrineFacade,
        ClientStorageFacadeInterface $clientStorageFacade
    ): FileFacadeInterface {
        $fileStorageFactory = $this->createFileStorageFactory($clientStorageFacade);

        $fileFactory = $this->createFileFactory(
            $uuidFacade,
            $doctrineFacade,
            $fileStorageFactory
        );

        return new FileFacade($fileFactory);
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
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginBackend';
    }
}
