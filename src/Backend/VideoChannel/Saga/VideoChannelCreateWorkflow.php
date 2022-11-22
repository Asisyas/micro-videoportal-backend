<?php

namespace App\Backend\VideoChannel\Saga;

use App\Shared\Common\Exception\UniqueConstraintException;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Exception\ChannelIdAlreadyExistsException;
use App\Shared\VideoChannel\Saga\VideoChannelActivityInterface;
use App\Shared\VideoChannel\Saga\VideoChannelCreateWorkflowInterface;
use Carbon\CarbonInterval;
use Doctrine\ORM\Exception\ORMException;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

class VideoChannelCreateWorkflow implements VideoChannelCreateWorkflowInterface
{
    /**
     * @var ActivityProxy<VideoChannelActivityInterface>
     */
    private readonly ActivityProxy $videoChannelActivity;

    public function __construct()
    {
        $this->videoChannelActivity = Workflow::newActivityStub(
            VideoChannelActivityInterface::class,
            ActivityOptions::new()
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)
                        ->withNonRetryableExceptions([
                            UniqueConstraintException::class,
                            ChannelIdAlreadyExistsException::class,
                            ORMException::class
                        ])
                )
                ->withStartToCloseTimeout(
                    CarbonInterval::second(30)
                )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoChannelCreateTransfer $videoChannelCreateTransfer)
    {
        yield $this->videoChannelActivity->createChannel($videoChannelCreateTransfer);
        yield $this->videoChannelActivity->publishChannel(
            (new VideoChannelGetTransfer())
                ->setChannelId($videoChannelCreateTransfer->getId())
        );

        return true;
    }
}