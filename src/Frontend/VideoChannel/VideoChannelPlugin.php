<?php

namespace App\Frontend\VideoChannel;

use App\Client\VideoChannel\Client\VideoChannelClientInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Frontend\VideoChannel\Facade\VideoChannelFacade;
use App\Frontend\VideoChannel\Facade\VideoChannelFacadeInterface;
use App\Frontend\VideoChannel\Handler\Create\ChannelCreateRequestHandlerFactory;
use App\Frontend\VideoChannel\Handler\Create\ChannelCreateRequestHandlerFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoChannelPlugin extends AbstractPlugin
{
    /**
     * @var VideoChannelClientInterface
     */
    private readonly VideoChannelClientInterface $videoChannelClient;

    /**
     * @var SecurityFacadeInterface
     */
    private readonly SecurityFacadeInterface $securityFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoChannelFacadeInterface::class, function (
            VideoChannelClientInterface $videoChannelClient,
            SecurityFacadeInterface $securityFacade
        ) {
            $this->videoChannelClient = $videoChannelClient;
            $this->securityFacade = $securityFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoChannelFacadeInterface
     */
    protected function createFacade(): VideoChannelFacadeInterface
    {
        return new VideoChannelFacade(
            $this->createChannelCreateRequestHandlerFactory()
        );
    }

    /**
     * @return ChannelCreateRequestHandlerFactoryInterface
     */
    protected function createChannelCreateRequestHandlerFactory(): ChannelCreateRequestHandlerFactoryInterface
    {
        return new ChannelCreateRequestHandlerFactory(
            $this->videoChannelClient,
            $this->securityFacade
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoChannelPluginFrontend';
    }
}
