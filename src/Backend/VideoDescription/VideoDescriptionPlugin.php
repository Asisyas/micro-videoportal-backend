<?php

namespace App\Backend\VideoDescription;

use App\Backend\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderFactory;
use App\Backend\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderFactoryInterface;
use App\Backend\VideoDescription\Business\Factory\Entity\VideoDescriptionEntityFactory;
use App\Backend\VideoDescription\Business\Factory\Entity\VideoDescriptionEntityFactoryInterface;
use App\Backend\VideoDescription\Business\Factory\Transfer\VideoDescriptionTransferFactory;
use App\Backend\VideoDescription\Business\Factory\Transfer\VideoDescriptionTransferFactoryInterface;
use App\Backend\VideoDescription\Business\Manager\VideoDescriptionManagerFactory;
use App\Backend\VideoDescription\Business\Manager\VideoDescriptionManagerFactoryInterface;
use App\Backend\VideoDescription\Facade\VideoDescriptionFacade;
use App\Backend\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class VideoDescriptionPlugin extends AbstractPlugin
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
        $container->register(VideoDescriptionFacadeInterface::class, function (
            DoctrineFacadeInterface $doctrineFacade
        ) {
            $this->doctrineFacade = $doctrineFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoDescriptionFacadeInterface
     */
    public function createFacade(): VideoDescriptionFacadeInterface
    {
        return new VideoDescriptionFacade(
            $this->createVideoDescriptionManagerFactory(),
        );
    }

    protected function createVideoDescriptionManagerFactory(): VideoDescriptionManagerFactoryInterface
    {
        $expanderFactory = $this->createVideoDescriptionEntityExpanderFactory();

        return new VideoDescriptionManagerFactory(
            $this->doctrineFacade,
            $this->createVideoDescriptionEntityFactory($expanderFactory),
            $this->createVideoDescriptionTransferFactory(),
            $expanderFactory
        );
    }

    /**
     * @param VideoDescriptionEntityExpanderFactoryInterface $expanderFactory
     * @return VideoDescriptionEntityFactoryInterface
     */
    protected function createVideoDescriptionEntityFactory(
        VideoDescriptionEntityExpanderFactoryInterface $expanderFactory): VideoDescriptionEntityFactoryInterface
    {
        return new VideoDescriptionEntityFactory($expanderFactory);
    }

    /**
     * @return VideoDescriptionTransferFactoryInterface
     */
    protected function createVideoDescriptionTransferFactory(): VideoDescriptionTransferFactoryInterface
    {
        return new VideoDescriptionTransferFactory();
    }

    /**
     * @return VideoDescriptionEntityExpanderFactoryInterface
     */
    protected function createVideoDescriptionEntityExpanderFactory(): VideoDescriptionEntityExpanderFactoryInterface
    {
        return new VideoDescriptionEntityExpanderFactory();
    }
}