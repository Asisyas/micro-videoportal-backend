<?php

namespace App\Backend\VideoPublish\Business\Index;

interface VideoIndexPropagateManagerFactoryInterface
{
    /**
     * @return VideoIndexPropagateManagerInterface
     */
    public function create(): VideoIndexPropagateManagerInterface;
}