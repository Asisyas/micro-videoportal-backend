<?php

namespace App\Backend\Video\Video\Business\Manager;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class VideoManagerFactory implements VideoManagerFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     */
    public function __construct(
        private readonly DoctrineFacadeInterface $doctrineFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoManagerInterface
    {
        return new VideoManager($this->doctrineFacade->getManager());
    }
}
