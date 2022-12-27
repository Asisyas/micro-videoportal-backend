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

namespace App\Shared\VideoChannel\Saga;

use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
#[\Temporal\Workflow\WorkflowInterface]
interface VideoChannelPropagateWorkflowInterface extends WorkflowInterface
{
    #[WorkflowMethod(name: 'Video_Channel_Propagate')] // @phpstan-ignore-line
    public function propagate(VideoChannelGetTransfer $videoChannelGetTransfer);
}
