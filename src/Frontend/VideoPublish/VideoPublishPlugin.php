<?php

namespace App\Frontend\VideoPublish;

use App\Client\File\Client\ClientFileInterface;
use App\Client\Video\Client\ClientVideoInterface;
use App\Frontend\VideoPublish\Facade\VideoPublishFacade;
use App\Frontend\VideoPublish\Facade\VideoPublishFacadeInterface;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactory;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoPublishPlugin extends AbstractPlugin
{
    /**
     * @var ClientVideoInterface
     */
    private readonly ClientVideoInterface $videoClient;

    private readonly ClientFileInterface $fileClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoPublishFacadeInterface::class, function (
            ClientVideoInterface $videoClient,
            ClientFileInterface $fileClient
        ) {
            $this->videoClient = $videoClient;
            $this->fileClient = $fileClient;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoPublishFacadeInterface
     */
    protected function createFacade(): VideoPublishFacadeInterface
    {
        return new VideoPublishFacade(
            $this->createVideoPublishTransferFactory(),
            $this->videoClient,
            $this->fileClient
        );
    }

    /**
     * @return VideoPublishTransferFactoryInterface
     */
    public function createVideoPublishTransferFactory(): VideoPublishTransferFactoryInterface
    {
        return new VideoPublishTransferFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoPublishPluginFrontend';
    }
}
