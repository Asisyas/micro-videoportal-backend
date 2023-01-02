<?php

namespace App\Backend\Video\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\VideoDescription\Saga\VideoDescriptionUpdateWorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

class VideoDescriptionUpdateWorkflow implements VideoDescriptionUpdateWorkflowInterface
{
    #[WorkflowMethod(name: 'update')]
    public function update(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool
    {
        return true;
    }
}
