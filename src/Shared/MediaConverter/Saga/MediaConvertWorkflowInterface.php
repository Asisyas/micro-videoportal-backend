<?php

namespace App\Shared\MediaConverter\Saga;

use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface MediaConvertWorkflowInterface extends WorkflowInterface
{
    /**
     * @param MediaConfigurationTransfer $mediaConfigurationTransfer
     *
     * @return MediaConvertedResultCollectionTransfer
     */
    #[WorkflowMethod("MediaConvert")]
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer);
}
