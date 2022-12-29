<?php

namespace App\Shared\Saga\VideoCreate;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Generator;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoCreateWorkflowInterface extends WorkflowInterface
{

}
