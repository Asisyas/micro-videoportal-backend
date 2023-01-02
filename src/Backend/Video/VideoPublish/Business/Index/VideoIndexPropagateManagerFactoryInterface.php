<?php

namespace App\Backend\Video\VideoPublish\Business\Index;

interface VideoIndexPropagateManagerFactoryInterface
{
    /**
     * @return VideoIndexPropagateManagerInterface
     */
    public function create(): VideoIndexPropagateManagerInterface;
}
