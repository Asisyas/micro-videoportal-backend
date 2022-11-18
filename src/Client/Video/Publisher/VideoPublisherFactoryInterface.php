<?php

namespace App\Client\Video\Publisher;

interface VideoPublisherFactoryInterface
{
    /**
     * @return VideoPublisherInterface
     */
    public function create(): VideoPublisherInterface;
}