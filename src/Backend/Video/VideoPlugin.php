<?php

namespace App\Backend\Video;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\Video\Business\Factory\VideoFactory;
use App\Backend\Video\Business\Factory\VideoFactoryInterface;
use App\Backend\Video\Facade\VideoFacade;
use App\Backend\Video\Facade\VideoFacadeInterface;
use App\Client\File\FileClientInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class VideoPlugin extends AbstractPlugin
{
    /**
     * @var DoctrineFacadeInterface
     */
    private readonly DoctrineFacadeInterface $doctrineFacade;

    /**
     * @var ClientStorageFacadeInterface
     */
    private ClientStorageFacadeInterface $clientStorageFacade;

    /**
     * @var FileClientInterface
     */
    private FileClientInterface $fileClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoFacadeInterface::class, function (
            DoctrineFacadeInterface $doctrineFacade,
            ClientStorageFacadeInterface $clientStorageFacade,
            FileClientInterface $fileClient
        ) {
            $this->doctrineFacade = $doctrineFacade;
            $this->clientStorageFacade = $clientStorageFacade;
            $this->fileClient = $fileClient;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoFacadeInterface
     */
    protected function createFacade(): VideoFacadeInterface
    {
        return new VideoFacade(
            $this->createVideoFactory(),
        );
    }

    /**
     * @return VideoFactoryInterface
     */
    protected function createVideoFactory(): VideoFactoryInterface
    {
        return new VideoFactory(
            $this->doctrineFacade,
            $this->clientStorageFacade,
            $this->fileClient
        );
    }
}