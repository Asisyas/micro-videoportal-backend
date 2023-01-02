<?php

namespace App\Frontend\VideoChannel;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Frontend\VideoChannel\Facade\VideoChannelFacade;
use App\Frontend\VideoChannel\Facade\VideoChannelFacadeInterface;
use App\Frontend\VideoChannel\Handler\Create\ChannelCreateRequestHandlerFactory;
use App\Frontend\VideoChannel\Handler\Create\ChannelCreateRequestHandlerFactoryInterface;
use App\Frontend\VideoChannel\Handler\Lookup\ChannelLookupRequestHandlerFactory;
use App\Frontend\VideoChannel\Handler\Lookup\ChannelLookupRequestHandlerFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;

class VideoChannelPlugin implements DependencyProviderInterface
{
    /**
     * @var ClientVideoChannelInterface
     */
    private readonly ClientVideoChannelInterface $videoChannelClient;

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
            ClientVideoChannelInterface $videoChannelClient,
            SecurityFacadeInterface     $securityFacade
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
            $this->createChannelCreateRequestHandlerFactory(),
            $this->createChannelLookupRequestHandlerFactory(),
        );
    }

    /**
     * @return ChannelLookupRequestHandlerFactoryInterface
     */
    protected function createChannelLookupRequestHandlerFactory(): ChannelLookupRequestHandlerFactoryInterface
    {
        return new ChannelLookupRequestHandlerFactory(
            $this->videoChannelClient,
            $this->securityFacade
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
