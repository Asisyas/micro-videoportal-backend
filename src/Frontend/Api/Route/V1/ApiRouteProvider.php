<?php

namespace App\Frontend\Api\Route\V1;


use App\Frontend\Api\Controller\ApiController;
use Micro\Plugin\Http\Business\Router\AbstractRouteProvider;
use Symfony\Component\Routing\Loader\Configurator\RouteConfigurator;

class ApiRouteProvider extends AbstractRouteProvider
{
    /**
     * {@inheritDoc}
     */
    public function getHttpKernelName(): string
    {
        return 'default';
    }

    /**
     * {@inheritDoc}
     */
    public function provideRouteCollection(RouteConfigurator $routeConfigurator): iterable
    {
        $router = $routeConfigurator->add(
            'api_v1',
            '/api/v1'
        );

        $router->add('api_endpoint', '/')
            ->controller([ApiController::class, 'index'])
            ->methods(['POST', 'GET'])
        ;

        yield $router;
    }
}