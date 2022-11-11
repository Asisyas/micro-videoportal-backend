<?php

namespace App\Frontend\VideoPublish;

use App\Client\File\FileClientInterface;
use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\File\Validator\FileUpload\FileUploadRequestValidatorFactory;
use App\Frontend\VideoPublish\Facade\VideoPublishFacade;
use App\Frontend\VideoPublish\Facade\VideoPublishFacadeInterface;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactory;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactoryInterface;
use App\Frontend\VideoPublish\Validator\RequestValidatorFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoPublishPlugin extends AbstractPlugin
{
    /**
     * @var FileClientInterface
     */
    private readonly FileClientInterface $fileClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoPublishFacadeInterface::class, function (
            FileClientInterface $fileClient
        ) {
            $this->fileClient = $fileClient;

            return $this->createFacade();
        });
    }

    /**
     * @return ArrayValidatorFactoryInterface
     */
    protected function createRequestValidatorFactory(): ArrayValidatorFactoryInterface
    {
        return new RequestValidatorFactory();
    }

    /**
     * @return VideoPublishFacadeInterface
     */
    protected function createFacade(): VideoPublishFacadeInterface
    {
        return new VideoPublishFacade(
            $this->createVideoPublishTransferFactory()
        );
    }

    /**
     * @return VideoPublishTransferFactoryInterface
     */
    public function createVideoPublishTransferFactory(): VideoPublishTransferFactoryInterface
    {
        return new VideoPublishTransferFactory($this->fileClient);
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoPublishPluginFrontend';
    }
}