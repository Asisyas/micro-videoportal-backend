<?php

namespace App\Client\Amqp\Receiver;

interface ReceiverFactoryInterface
{
    /**
     * @return ReceiverInterface
     */
    public function create(): ReceiverInterface;
}