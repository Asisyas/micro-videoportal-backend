<?php

namespace App\Saga\VideoUpload\Workflow;

use App\Saga\VideoUpload\Activity\UploadVideoActivityInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\Video\SourceFileMetadataTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Generated\DTO\VideoConverterConfigTransfer;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;
use Temporal\Workflow\QueryMethod;
use Temporal\Workflow\Saga;

class VideoUploadWorkflow implements VideoUploadWorkflowInterface
{

    private ?VideoTransfer $videoTransfer = null;

    /**
     * @var UploadVideoActivityInterface
     */
    private ActivityProxy $activity;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(
            UploadVideoActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::hour(1))
                // disable retries for example to run faster
                ->withRetryOptions(RetryOptions::new()->withMaximumAttempts(1))
        );
    }

    public function initializeVideo(FileGetTransfer $fileGetTransfer): \Generator
    {
        $saga = new Saga();

        // Configure SAGA to run compensation activities in parallel
        $saga->setParallelCompensation(true);

        try {
            $videoFile = yield $this->activity->lookupSourceFile($fileGetTransfer);
            /** @var SourceFileMetadataTransfer $metadata */
            $metadata = yield $this->activity->extractVideoMetadata($videoFile);
            $result = [
                'title' => $metadata->getName(),
                'resolutions' => []
            ];
            foreach ($metadata->getResolution() as $resolution) {
                $configTransfer = new VideoConverterConfigTransfer();
                $configTransfer
                    ->setFile($videoFile)
                    ->setMetadata($metadata)
                    ->setResolution($resolution)
                ;

                $result['resolutions'][] = yield $this->activity->convertVideo($configTransfer);
            }

            //$saga->addCompensation(fn() => yield $this->activities->cancelHotel($hotelReservationID, $name));

            return $result;
        } catch (\Throwable $e) {
            yield $saga->compensate();

            throw $e;
        }
    }

    public function queryGreeting(): ?VideoTransfer
    {
        return $this->videoTransfer;
    }
}