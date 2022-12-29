<?php

namespace App\Frontend\VideoPublish;

use App\Client\File\FileClientInterface;
use App\Client\Video\Client\VideoClientInterface;
use App\Frontend\VideoPublish\Facade\VideoPublishFacade;
use App\Frontend\VideoPublish\Facade\VideoPublishFacadeInterface;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactory;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoPublishPlugin extends AbstractPlugin
{
    /**
     * @var VideoClientInterface
     */
    private readonly VideoClientInterface $videoClient;

    private readonly FileClientInterface $fileClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoPublishFacadeInterface::class, function (
            VideoClientInterface $videoClient,
            FileClientInterface $fileClient
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
