<?php

namespace App\Frontend\VideoPublish;

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

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoPublishFacadeInterface::class, function (
            VideoClientInterface $videoClient
        ) {
            $this->videoClient = $videoClient;

            return $this->createFacade();
        });
    }

    protected function createFacade(): VideoPublishFacade
    {
        return new VideoPublishFacade(
            $this->createVideoPublishTransferFactory(),
            $this->videoClient
        );
    }

    public function createVideoPublishTransferFactory(): VideoPublishTransferFactory
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
