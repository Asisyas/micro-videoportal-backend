<?php

namespace App\Backend\Video;

use App\Backend\Video\Business\Manager\VideoManagerFactory;
use App\Backend\Video\Business\Manager\VideoManagerFactoryInterface;
use App\Backend\Video\Facade\VideoFacade;
use App\Backend\Video\Facade\VideoFacadeInterface;
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
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoFacadeInterface::class, function (
            DoctrineFacadeInterface $doctrineFacade
        ) {
            $this->doctrineFacade = $doctrineFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoFacadeInterface
     */
    protected function createFacade(): VideoFacadeInterface
    {
        return new VideoFacade(
            $this->createVideoManagerFactory(),
        );
    }

    /**
     * @return VideoManagerFactoryInterface
     */
    protected function createVideoManagerFactory(): VideoManagerFactoryInterface
    {
        return new VideoManagerFactory(
            $this->doctrineFacade
        );
    }
}