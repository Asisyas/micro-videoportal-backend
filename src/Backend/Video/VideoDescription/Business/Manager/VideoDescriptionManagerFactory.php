<?php

namespace App\Backend\Video\VideoDescription\Business\Manager;

use App\Backend\Video\VideoDescription\Business\Expander\Entity\VideoDescriptionEntityExpanderFactoryInterface;
use App\Backend\Video\VideoDescription\Business\Factory\Entity\VideoDescriptionEntityFactoryInterface;
use App\Backend\Video\VideoDescription\Business\Factory\Transfer\VideoDescriptionTransferFactoryInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class VideoDescriptionManagerFactory implements VideoDescriptionManagerFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface                           $doctrineFacade
     * @param VideoDescriptionEntityFactoryInterface            $videoDescriptionEntityFactory
     * @param VideoDescriptionTransferFactoryInterface          $videoDescriptionTransferFactory
     * @param VideoDescriptionEntityExpanderFactoryInterface    $videoDescriptionEntityExpander
     */
    public function __construct(
        private readonly DoctrineFacadeInterface                            $doctrineFacade,
        private readonly VideoDescriptionEntityFactoryInterface             $videoDescriptionEntityFactory,
        private readonly VideoDescriptionTransferFactoryInterface           $videoDescriptionTransferFactory,
        private readonly VideoDescriptionEntityExpanderFactoryInterface     $videoDescriptionEntityExpander
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoDescriptionManagerInterface
    {
        return new VideoDescriptionManager(
            $this->doctrineFacade->getManager(),
            $this->videoDescriptionEntityFactory,
            $this->videoDescriptionTransferFactory,
            $this->videoDescriptionEntityExpander->create(),
        );
    }
}
