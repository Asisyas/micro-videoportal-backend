<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoDescriptionCreateWorkflowInterface extends WorkflowInterface
{

}
