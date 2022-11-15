<?php

namespace App\Client\Video\Workflow;

use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Saga\VideoUpdate\VideoUpdateActivityInterface;
use App\Shared\Video\Saga\VideoUpdate\VideoUpdateWorkflowInterface;
use Doctrine\ORM\EntityNotFoundException;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

class VideoUpdateWorkflow implements VideoUpdateWorkflowInterface
{
    /**
     * @var VideoUpdateActivityInterface
     */
    private ActivityProxy $activity;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(VideoUpdateActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(30)
                ->withHeartbeatTimeout(30)
                ->withScheduleToCloseTimeout(30)
                ->withScheduleToStartTimeout(29)
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(1)
                        ->withNonRetryableExceptions([
                            EntityNotFoundException::class
                        ])
                )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideo(VideoTransfer $videoTransfer)
    {
        return yield $this->activity->updateVideo($videoTransfer);
    }
}