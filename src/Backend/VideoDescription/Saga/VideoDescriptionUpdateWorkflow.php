<?php

namespace App\Backend\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\VideoDescription\Saga\VideoDescriptionUpdateWorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

class VideoDescriptionUpdateWorkflow implements VideoDescriptionUpdateWorkflowInterface
{
    #[WorkflowMethod(name: 'update')] public function update(VideoDescriptionTransfer $videoDescriptionTransfer): bool
    {

    }
}