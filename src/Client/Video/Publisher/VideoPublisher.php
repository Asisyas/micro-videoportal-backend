<?php

namespace App\Client\Video\Publisher;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Saga\VideoPublish\VideoPublishWorkflowInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Temporal\Client\WorkflowClientInterface;

class VideoPublisher implements VideoPublisherInterface
{
    /**
     * @param TemporalFacadeInterface $temporalFacade
     */
    public function __construct(
        private readonly WorkflowClientInterface $workflowClient
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function publish(FileGetTransfer $fileGetTransfer): void
    {
        $stub = $this->workflowClient->newWorkflowStub(VideoPublishWorkflowInterface::class);

        $this->workflowClient->start($stub, $fileGetTransfer);
    }
}