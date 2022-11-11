<?php

namespace App\Saga\VideoPublish\Workflow;

use App\Saga\VideoPublish\Activity\VideoPublishActivityInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\Video\ResolutionSimpleTransfer;
use App\Shared\Generated\DTO\VideoConverter\PublishStatusTransfer;
use App\Shared\VideoConverter\Configuration;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;
use Temporal\Workflow\Saga;

class VideoPublishWorkflow implements VideoPublishWorkflowInterface
{
    /** @var VideoPublishActivityInterface */
    private ActivityProxy $activity;

    /** @var PublishStatusTransfer  */
    private PublishStatusTransfer $videoPublishStatus;

    public function __construct()
    {
        $this->videoPublishStatus = (new PublishStatusTransfer())->setStatus(0);

        $this->updateProcessStatus(Configuration::STATUS_PENDING, '|');

        $this->activity = Workflow::newActivityStub(
            VideoPublishActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::hour(24))
            //    ->withTaskQueue('VideoPublish')
                ->withRetryOptions(RetryOptions::new()->withMaximumAttempts(1))
        );
    }

    /**
     * {@inheritDoc}
     */
    public function lookupStatus(): PublishStatusTransfer
    {
        return $this->videoPublishStatus;
    }

    /**
     * {@inheritDoc}
     */
    #[Workflow\WorkflowMethod("VideoPublish")]
    public function publish(FileGetTransfer $fileGetTransfer)
    {
        $saga = new Saga();
        $saga->setParallelCompensation(true);

        $saga->addCompensation(function() {
            $this->updateProcessStatus(Configuration::STATUS_IS_PROGRESS, '^');
            $this->updateProcessStatus(Configuration::STATUS_FAIL, '|');
        });
        try {
            $this->updateProcessStatus(Configuration::STATUS_PENDING, '^');
            $this->updateProcessStatus(Configuration::STATUS_CONVERT_IN_PROGRESS, '|');

            $fileTransfer = yield $this->activity->lookupSourceFile($fileGetTransfer);
            $saga->addCompensation(fn() => yield $this->activity
                ->removeSourceFile((new FileRemoveTransfer())->setId($fileTransfer->getId())));

            $videoMetadata = yield $this->activity->extractVideoMetadata($fileTransfer);
            $resolutions = yield $this->activity->calculateVideoResolutions($videoMetadata);
            $this->updateProcessStatus(Configuration::STATUS_CONVERT_IN_PROGRESS, '|');
            foreach ($resolutions->getResolutions() as $resolution) {
                /** @var ResolutionSimpleTransfer $videoConvertedTransfer */
                $videoConvertedTransfer = yield $this->activity->convertVideo($fileTransfer, $resolution);
                $this->addResolution($videoConvertedTransfer);
            }

            $this->updateProcessStatus(Configuration::STATUS_CONVERT_IN_PROGRESS, '^');
            $this->updateProcessStatus(Configuration::STATUS_CONVERT_SUCCESS, '|');

            return 'CONVERTED!';

        } catch (\Throwable $exception) {
            $saga->compensate();

            throw $exception;
        }
    }

    protected function addResolution(ResolutionSimpleTransfer $resolutionSimpleTransfer): void
    {
        $this->videoPublishStatus->setResolutions([$resolutionSimpleTransfer]);
    }

    /**
     * @param int $statusMask
     * @param string $operation
     *
     * @return void
     */
    protected function updateProcessStatus(int $statusMask, string $operation): void
    {
        $status = $this->videoPublishStatus->getStatus();
        switch ($operation) {
            case '&':
                $status &= $statusMask;
                break;
            case '|':
                $status |= $statusMask;
                break;
            case '^':
                $status ^= $statusMask;
        }

        $this->videoPublishStatus->setStatus($status);
    }
}