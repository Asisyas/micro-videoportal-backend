<?php

namespace App\Shared\VideoChannel\Saga;

use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoChannelCreateWorkflowInterface extends WorkflowInterface
{
    /**
     * @param VideoChannelCreateTransfer $videoChannelCreateTransfer
     *
     * @return VideoChannelTransfer
     */
    #[WorkflowMethod(name: 'Video_Channel_Create')]
    public function create(VideoChannelCreateTransfer $videoChannelCreateTransfer);
}
