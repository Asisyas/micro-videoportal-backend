<?php

namespace App\Shared\Saga\VideoUpdate;

use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoUpdateWorkflowInterface extends WorkflowInterface
{

}
