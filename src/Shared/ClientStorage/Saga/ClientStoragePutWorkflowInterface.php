<?php

namespace App\Shared\ClientStorage\Saga;


use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use Micro\Plugin\Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[\Temporal\Workflow\WorkflowInterface]
interface ClientStoragePutWorkflowInterface extends WorkflowInterface
{
    #[WorkflowMethod(name: 'Storage_Put_Object')]
    public function put(PutTransfer $putTransfer);
}