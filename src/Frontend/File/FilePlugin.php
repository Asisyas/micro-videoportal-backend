<?php

namespace App\Frontend\File;

use App\Client\File\FileClientInterface;
use App\Client\Security\Client\SecurityClientInterface;
use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\File\Expander\FileUpload\FileUploadTransferExpanderFactory;
use App\Frontend\File\Expander\FileUpload\FileUploadTransferExpanderFactoryInterface;
use App\Frontend\File\Facade\FileFacade;
use App\Frontend\File\Facade\FileFacadeInterface;
use App\Frontend\File\Factory\FileUploadTransferFactory;
use App\Frontend\File\Upload\FileUploaderFactory;
use App\Frontend\File\Upload\FileUploaderFactoryInterface;
use App\Frontend\File\Validator\FileUpload\FileUploadRequestValidatorFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class FilePlugin extends AbstractPlugin
{
    private FileClientInterface $fileClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(FileFacadeInterface::class, function (
            FileClientInterface $fileClient
        ) {
            $this->fileClient = $fileClient;

            return $this->createFacade();
        });
    }

    /**
     * @return FileFacadeInterface
     */
    protected function createFacade(): FileFacadeInterface
    {
        return new FileFacade(
            $this->createFileUploaderFactory(),
        );
    }

    /**
     * @return FileUploadTransferFactory
     */
    public function createFileUploadTransferFactory(): FileUploadTransferFactory
    {
        return new FileUploadTransferFactory(
            $this->createFileUploadTransferExpanderFactory(),
            $this->createUploadRequestValidatorFactory()
        );
    }

    /**
     * @return FileUploaderFactoryInterface
     */
    public function createFileUploaderFactory(): FileUploaderFactoryInterface
    {
        return new FileUploaderFactory(
            $this->createFileUploadTransferFactory(),
            $this->fileClient
        );
    }

    /**
     * @return FileUploadTransferExpanderFactoryInterface
     */
    protected function createFileUploadTransferExpanderFactory(): FileUploadTransferExpanderFactoryInterface
    {
        return new FileUploadTransferExpanderFactory();
    }

    /**
     * @return ArrayValidatorFactoryInterface
     */
    protected function createUploadRequestValidatorFactory(): ArrayValidatorFactoryInterface
    {
        return new FileUploadRequestValidatorFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginFrontend';
    }
}
