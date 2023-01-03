<?php

namespace App\Frontend\VideoPublish;

use App\Client\File\Client\ClientFileInterface;
use App\Client\Video\Client\ClientVideoInterface;
use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
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

    /**
     * @var ClientFileInterface
     */
    private readonly ClientFileInterface $fileClient;
    /**
     * @var SecurityFacadeInterface
     */
    private readonly SecurityFacadeInterface $securityFacade;

    /**
     * @var ClientVideoChannelInterface
     */
    private readonly ClientVideoChannelInterface $clientVideoChannel;

    /**
     * private readonly SecurityFacadeInterface $securityFacade,
    private readonly ClientVideoChannelInterface $clientVideoChannel
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoPublishFacadeInterface::class, function (
            ClientVideoInterface $videoClient,
            ClientFileInterface $fileClient,
            SecurityFacadeInterface $securityFacade,
            ClientVideoChannelInterface $clientVideoChannel
        ) {
            $this->videoClient = $videoClient;
            $this->fileClient = $fileClient;
            $this->securityFacade = $securityFacade;
            $this->clientVideoChannel = $clientVideoChannel;

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
        return new VideoPublishTransferFactory(
            $this->securityFacade,
            $this->clientVideoChannel
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoPublishPluginFrontend';
    }
}
