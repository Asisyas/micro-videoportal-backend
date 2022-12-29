<?php

namespace App\Backend\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\VideoDescription\Saga\VideoDescriptionUpdateWorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

class VideoDescriptionUpdateWorkflow implements VideoDescriptionUpdateWorkflowInterface
{
    /**
     * @return true
     */
    #[WorkflowMethod(name: 'update')]
    public function update(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool
    {
        return true;
    }
}
