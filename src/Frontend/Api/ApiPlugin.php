<?php

namespace App\Frontend\Api;

use App\Frontend\Api\Route\V1\ApiRouteProvider;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Http\Business\Plugin\RouteProviderPluginInterface;

class ApiPlugin extends AbstractPlugin implements RouteProviderPluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function getRouteProviders(): iterable
    {
        return [
            new ApiRouteProvider(),
        ];
    }
}