<?php

namespace App\Shared\VideoDescription\Saga;

use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoDescriptionCreateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoDescriptionTransfer $videoDescriptionTransfer
     *
     * @return mixed
     */
    #[WorkflowMethod(name: 'create')]
    public function create(VideoDescriptionTransfer $videoDescriptionTransfer);
}