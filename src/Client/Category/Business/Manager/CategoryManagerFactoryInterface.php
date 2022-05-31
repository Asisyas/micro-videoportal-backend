<?php

namespace App\Client\Category\Business\Manager;

interface CategoryManagerFactoryInterface
{
    /**
     * @return CategoryManagerInterface
     */
    public function create(): CategoryManagerInterface;
}