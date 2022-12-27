<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoDescriptionDeleteWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer
     *
     * @return bool
     */
    #[WorkflowMethod(name: 'delete')]
    public function delete(VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer): bool;
}
