<?php

namespace App\Backend\VideoChannel\Business\Publisher;

interface PublisherFactoryInterface
{
    /**
     * @return PublisherInterface
     */
    public function create(): PublisherInterface;
}