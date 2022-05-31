<?php

namespace App\Client\Amqp\Publisher;

interface PublisherFactoryInterface
{
    /**
     * @return PublisherInterface
     */
    public function create(): PublisherInterface;
}