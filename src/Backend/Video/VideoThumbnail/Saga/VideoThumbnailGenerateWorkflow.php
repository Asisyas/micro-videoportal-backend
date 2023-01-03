<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Backend\Video\VideoThumbnail\Saga;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\VideoThumbnail\Saga\VideoThumbnailActivityInterface;
use App\Shared\VideoThumbnail\Saga\VideoThumbnailGenerateWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Workflow;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoThumbnailGenerateWorkflow implements VideoThumbnailGenerateWorkflowInterface
{
    /**
     * @inheritDoc
     */
    public function generateThumbnail(VideoGetTransfer $videoGetTransfer)
    {
        $thumbnailResult = yield $this->createActivity()->generateThumbnail($videoGetTransfer);

        return $thumbnailResult;
    }

    /**
     * @return VideoThumbnailActivityInterface
     */
    protected function createActivity()
    {
        return Workflow::newActivityStub(
            VideoThumbnailActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::minute(20))
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)
                        ->withNonRetryableExceptions([
                            NotFoundException::class
                        ])
                )
        );
    }
}
