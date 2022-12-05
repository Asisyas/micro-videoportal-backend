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

namespace App\Backend\VideoChannel\Saga;

use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\VideoChannel\Saga\VideoChannelActivityInterface;
use App\Shared\VideoChannel\Saga\VideoChannelPropagateWorkflowInterface;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoChannelPropagateWorkflow implements VideoChannelPropagateWorkflowInterface
{
    private ActivityProxy $activity;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(VideoChannelActivityInterface::class,
            ActivityOptions::new()
                ->withScheduleToCloseTimeout(
                    CarbonInterval::minute()
                )
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)
                )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function propagate(VideoChannelGetTransfer $videoChannelGetTransfer)
    {
        yield $this->activity->publishChannel($videoChannelGetTransfer);
    }
}