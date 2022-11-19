<?php

namespace App\Shared\MediaConverter\Saga;

use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use Generator;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface MediaConvertWorkflowInterface extends WorkflowInterface
{
    /**
     * @param MediaConfigurationTransfer $mediaConfigurationTransfer
     *
     * @return Generator<MediaConvertedResultTransfer>
     */
    #[WorkflowMethod("MediaConvert")]
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer): Generator;
}