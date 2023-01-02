<?php

namespace App\Client\Video\Publisher;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Video\VideoPublishWorkflowInterface;
use Temporal\Client\WorkflowClientInterface;
use Temporal\Client\WorkflowOptions;

class VideoPublisher implements VideoPublisherInterface
{
    /**
     * @param WorkflowClientInterface $workflowClient
     */
    public function __construct(
        private readonly WorkflowClientInterface $workflowClient
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function publish(VideoPublishTransfer $videoPublishTransfer): void
    {
        $stub = $this->workflowClient->newWorkflowStub(
            VideoPublishWorkflowInterface::class,
            WorkflowOptions::new()->withWorkflowId($videoPublishTransfer->getFileId())
        );

        $this->workflowClient->start($stub, $videoPublishTransfer);
    }
}
