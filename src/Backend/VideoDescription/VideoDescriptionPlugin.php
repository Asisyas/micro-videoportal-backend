<?php

namespace App\Backend\VideoDescription;

use App\Backend\VideoDescription\Facade\VideoDescriptionFacade;
use App\Backend\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoDescriptionPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoDescriptionFacadeInterface::class, function () {
            return $this->createFacade();
        });
    }

    public function createFacade(): VideoDescriptionFacadeInterface
    {
        return new VideoDescriptionFacade();
    }
}