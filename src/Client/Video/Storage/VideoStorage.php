<?php

namespace App\Client\Video\Storage;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Saga\CreateVideo\VideoCreateWorkflowInterface;
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
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
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
}