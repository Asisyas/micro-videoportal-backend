<?php

namespace App\Backend\Video\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Video\VideoActivityInterface;
use App\Shared\Video\VideoPublishActivityInterface;
use App\Shared\Video\VideoUpdateSrcWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

class VideoUpdateSrcWorkflow implements VideoUpdateSrcWorkflowInterface
{
    private readonly ActivityProxy $videoActivity;
    private readonly ActivityProxy $videoPropagateActivity;

    public function __construct()
    {
        $this->videoActivity = Workflow::newActivityStub(
            VideoActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(
                    CarbonInterval::minute(1)
                )
        );

        $this->videoPropagateActivity = Workflow::newActivityStub(
            VideoPublishActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(
                    CarbonInterval::minute(1)
                )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer) //@phpstan-ignore-line
    {
        yield $this->videoActivity->updateVideoSrc($videoSrcSetTransfer);
        $isTrue = yield $this->videoPropagateActivity->propagateVideo(
            (new VideoGetTransfer())->setVideoId($videoSrcSetTransfer->getVideoId())
        );

        return $isTrue;
    }
}
