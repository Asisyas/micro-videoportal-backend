<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoDescriptionUpdateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoDescriptionTransfer $videoDescriptionTransfer
     *
     * @return bool
     */
    #[WorkflowMethod(name: 'update')]
    public function update(VideoDescriptionTransfer $videoDescriptionTransfer): bool;
}