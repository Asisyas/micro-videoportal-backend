<?php

namespace App\Backend\Saga\VideoUpdate;

use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Saga\VideoUpdate\VideoUpdateActivityInterface;
use App\Shared\Saga\VideoUpdate\VideoUpdateWorkflowInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
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
                            Exception::class,
                            ORMException::class
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