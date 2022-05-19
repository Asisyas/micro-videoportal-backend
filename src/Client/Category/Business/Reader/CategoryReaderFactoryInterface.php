<?php

namespace App\Client\Category\Business\Reader;

interface CategoryReaderFactoryInterface
{
    /**
     * @return CategoryReaderInterface
     */
    public function create(): CategoryReaderInterface;
}