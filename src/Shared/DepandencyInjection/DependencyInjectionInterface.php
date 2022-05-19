<?php

namespace App\Shared\DependencyInjection;

use Micro\Component\DependencyInjection\Container;

interface DependencyInjectionInterface
{
    /**
     * @param Container $container
     * @return void
     */
    public function provide(Container $container): void;
}