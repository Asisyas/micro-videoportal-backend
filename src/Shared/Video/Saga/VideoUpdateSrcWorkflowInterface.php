<?php

namespace App\Shared\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;
use Generator;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowInterface as TemporalWorkflow;
use Temporal\Workflow\WorkflowMethod;

#[TemporalWorkflow]
interface VideoUpdateSrcWorkflowInterface extends WorkflowInterface
{

}
