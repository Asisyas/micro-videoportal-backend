<?php

namespace App\Frontend\Api\Controller;

use Micro\Plugin\Http\Exception\HttpException;
use Micro\Plugin\Logger\LoggerFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    public function __construct(private readonly LoggerFacadeInterface $loggerFacade)
    {

    }

    public function home(Request $request, UuidFacadeInterface $uuidFacade): Response
    {
        throw new \Exception('Invalid Request !');
    }
}