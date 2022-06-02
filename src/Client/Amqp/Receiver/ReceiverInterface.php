<?php

namespace App\Client\Amqp\Receiver;

use App\Shared\Generated\DTO\Amqp\TaskStatusRequestTransfer;
use App\Shared\Generated\DTO\Amqp\TaskStatusResponseTransfer;

interface ReceiverInterface
{
    /**
     * @param TaskStatusRequestTransfer $taskStatusRequestTransfer
     *
     * @return TaskStatusResponseTransfer
     */
    public function receive(TaskStatusRequestTransfer $taskStatusRequestTransfer): TaskStatusResponseTransfer;
}