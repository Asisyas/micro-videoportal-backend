<?php

namespace App\Client\Video\Storage;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Saga\VideoCreate\VideoCreateWorkflowInterface;
use App\Shared\Saga\VideoUpdate\VideoUpdateWorkflowInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class VideoStorage implements VideoStorageInterface
{
    /**
     * @param TemporalFacadeInterface $temporalFacade
     */
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        $client = $this->temporalFacade->workflowClient();
        $stub = $client->newWorkflowStub(
            VideoCreateWorkflowInterface::class
        );

        $run = $client->start($stub, $videoCreateTransfer);

        return $run->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer
    {
        $client = $this->temporalFacade->workflowClient();
        $stub = $client->newWorkflowStub(
            VideoUpdateWorkflowInterface::class
        );

        $run = $client->start($stub, $videoTransfer);

        return $run->getResult();
    }
}