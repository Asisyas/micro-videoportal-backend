<?php

namespace App\Frontend\ActionStatus\Controller;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Shared\Generated\DTO\Amqp\TaskStatusRequestTransfer;
use App\Shared\Generated\DTO\Amqp\TaskStatusResponseTransfer;
use Micro\Library\DTO\Exception\SerializeException;
use Micro\Plugin\Amqp\TaskStatus\Core\Exception\AmqpTaskStatusNotFoundException;
use Micro\Plugin\Http\Exception\BadRequestException;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionStatusController
{
    public function __construct(
        private readonly AmqpClientInterface $amqpClient
    )
    {
    }

    /**
     * @param Request $request
     * @return Response
     * @throws HttpNotFoundException
     *
     * @throws \Micro\Library\DTO\Exception\SerializeException
     */
    public function getStatus(Request $request): TaskStatusResponseTransfer
    {
        $taskId = $request->get('channel_id');
        $requestTransfer = new TaskStatusRequestTransfer();
        $requestTransfer->setChannelId($taskId);
        try {
            $received = $this->amqpClient->receiveStatus($requestTransfer);
        } catch (AmqpTaskStatusNotFoundException $e) {
            throw new HttpNotFoundException();
        } catch (SerializeException $exception) {
            throw new BadRequestException();
        }

        return $received;
    }
}