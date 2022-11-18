<?php

namespace App\Backend\Video\Business\IndexProvider;

interface IndexPopulateProviderFactoryInterface
{
    /**
     * @return IndexPopulateProviderInterface
     */
    public function create(): IndexPopulateProviderInterface;
}