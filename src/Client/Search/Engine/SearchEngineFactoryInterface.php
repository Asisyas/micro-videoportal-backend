<?php

namespace App\Client\Search\Engine;

interface SearchEngineFactoryInterface
{
    /**
     * @return SearchEngineInterface
     */
    public function create(): SearchEngineInterface;
}
