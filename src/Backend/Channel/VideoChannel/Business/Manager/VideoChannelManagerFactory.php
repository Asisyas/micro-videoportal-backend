<?php

namespace App\Backend\Channel\VideoChannel\Business\Manager;

use App\Backend\Channel\VideoChannel\Business\Expander\Entity\VideoChannelEntityExpanderFactoryInterface;
use App\Backend\Channel\VideoChannel\Business\Expander\Transfer\VideoChannelTransferExpanderFactoryInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;

class VideoChannelManagerFactory implements VideoChannelManagerFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param VideoChannelEntityExpanderFactoryInterface $channelEntityExpanderFactory
     * @param VideoChannelTransferExpanderFactoryInterface $channelTransferExpanderFactory
     */
    public function __construct(
        private readonly DoctrineFacadeInterface $doctrineFacade,
        private readonly VideoChannelEntityExpanderFactoryInterface $channelEntityExpanderFactory,
        private readonly VideoChannelTransferExpanderFactoryInterface $channelTransferExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoChannelManagerInterface
    {
        return new VideoChannelManager(
            $this->doctrineFacade->getManager(),
            $this->channelEntityExpanderFactory,
            $this->channelTransferExpanderFactory,
        );
    }
}
