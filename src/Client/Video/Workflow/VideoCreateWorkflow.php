<?php

namespace App\Client\Video\Workflow;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Saga\CreateVideo\VideoCreateActivityInterface;
use App\Shared\Video\Saga\CreateVideo\VideoCreateWorkflowInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Exception\ORMException;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

class VideoCreateWorkflow implements VideoCreateWorkflowInterface
{
    /**
     * @var VideoCreateActivityInterface
     */
    private ActivityProxy $activity;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(VideoCreateActivityInterface::class,
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
    public function createVideo(VideoCreateTransfer $videoCreateTransfer)
    {
        $saga = new Workflow\Saga();
        try {
            /** @var VideoTransfer $videoTransfer */
            $videoTransfer = yield $this->activity->createVideo($videoCreateTransfer);
        } catch (\Throwable $exception) {
            $saga->compensate();

            throw $exception;
        }

        return $videoTransfer;
    }
}