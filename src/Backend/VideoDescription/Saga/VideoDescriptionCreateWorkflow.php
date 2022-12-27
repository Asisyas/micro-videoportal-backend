<?php

namespace App\Backend\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\VideoDescription\Saga\VideoDescriptionCreateActivityInterface;
use App\Shared\VideoDescription\Saga\VideoDescriptionCreateWorkflowInterface;
use Doctrine\ORM\Exception\ORMException;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

class VideoDescriptionCreateWorkflow implements VideoDescriptionCreateWorkflowInterface
{
    private ActivityProxy $activity;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(
            VideoDescriptionCreateActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(20)
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withNonRetryableExceptions([
                            ORMException::class
                        ])
                )
        );
    }

    /**
     * {@inheritDoc}
     */
    #[Workflow\WorkflowMethod(name: 'Video_Description_Create')]
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer)
    {
        yield $this->activity->create($videoDescriptionPutTransfer);
    }
}
