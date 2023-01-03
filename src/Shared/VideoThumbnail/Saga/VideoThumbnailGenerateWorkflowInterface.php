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

namespace App\Shared\VideoThumbnail\Saga;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
#[\Temporal\Workflow\WorkflowInterface]
interface VideoThumbnailGenerateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return mixed
     */
    #[WorkflowMethod(name: 'Video_Thumbnail_Generate')]
    public function generateThumbnail(VideoGetTransfer $videoGetTransfer);
}
