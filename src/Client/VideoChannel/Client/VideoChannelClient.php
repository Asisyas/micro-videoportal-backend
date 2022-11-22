<?php

namespace App\Client\VideoChannel\Client;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Constants;
use App\Shared\VideoChannel\Saga\VideoChannelCreateWorkflowInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;


/**
 * TODO: Simple PoC solution
 */
class VideoChannelClient implements VideoChannelClientInterface
{
    /**
     * @param TemporalFacadeInterface $temporalFacade
     * @param ClientReaderFacadeInterface $clientReaderFacade
     */
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade,
        private readonly ClientReaderFacadeInterface $clientReaderFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): VideoChannelTransfer
    {
        $client = $this->temporalFacade->workflowClient();
        $workflow = $client->newWorkflowStub(
            VideoChannelCreateWorkflowInterface::class
        );

        $client
            ->start($workflow, $videoChannelCreateTransfer)
            ->getResult();

        return $this->lookupChannel(
            (new VideoChannelGetTransfer())
                ->setChannelId($videoChannelCreateTransfer->getId())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function lookupChannel(VideoChannelGetTransfer $videoChannelGetTransfer): VideoChannelTransfer
    {
        /** @var VideoChannelTransfer $channelTransfer */
        $channelTransfer =  $this->clientReaderFacade->lookup(
            (new RequestTransfer())
                ->setIndex(Constants::STORAGE_IDX)
                ->setUuid($videoChannelGetTransfer->getChannelId())
        )->getData();

        return $channelTransfer;
    }
}