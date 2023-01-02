<?php

namespace App\Backend\Channel\VideoChannel\Business\Publisher;

interface PublisherFactoryInterface
{
    /**
     * @return PublisherInterface
     */
    public function create(): PublisherInterface;
}
