<?php

namespace App\Saga\VideoUpload\Workflow;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\QueryMethod;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface VideoUploadWorkflowInterface extends WorkflowInterface
{
    #[WorkflowMethod("SagaVideoInitialize")]
    public function initializeVideo(FileGetTransfer $fileGetTransfer): \Generator;

    #[QueryMethod]
    public function queryGreeting(): ?VideoTransfer;
}