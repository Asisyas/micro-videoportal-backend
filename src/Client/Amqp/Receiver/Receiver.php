<?php

namespace App\Client\Amqp\Receiver;

use App\Shared\Generated\DTO\Amqp\TaskStatusRequestTransfer;
use App\Shared\Generated\DTO\Amqp\TaskStatusResponseTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\TaskStatus\Core\Business\Client\Driver\ClientTaskStatusDriverInterface;
use Micro\Plugin\Amqp\TaskStatus\Core\Model\TaskStatus;

class Receiver implements ReceiverInterface
{
    public function __construct(
        private ClientTaskStatusDriverInterface $clientTaskStatusDriver,
        private SerializerFacadeInterface $serializerFacade
    )
    {

    }

    public function receive(TaskStatusRequestTransfer $taskStatusRequestTransfer): TaskStatusResponseTransfer
    {
        $taskUuid = $taskStatusRequestTransfer->getChannelId();
        $message = $this->clientTaskStatusDriver->receiveStatus($taskUuid);
        $response = new TaskStatusResponseTransfer();
        $response->setStatus($message->getStatus());
        $response->setChannelId($message->getTaskId());
        $response->setCreatedAt($message->getCreatedAt());
        $response->setUpdatedAt($message->getUpdatedAt());
        $content = $message->getResultContent();
        if($content && $message->getStatus() ^ TaskStatus::FLAG_REJECTED) {
            $content = $this->serializerFacade->fromJsonTransfer($content);
        }

        $response->setResult($content);

        return $response;
    }
}