<?php

namespace App\Shared\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Generator;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowInterface as TemporalWorkflow;
use Temporal\Workflow\WorkflowMethod;

#[TemporalWorkflow]
interface VideoCreateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return Generator<VideoTransfer>
     */
    #[WorkflowMethod(name: 'VideoCreate')]
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): Generator;
}