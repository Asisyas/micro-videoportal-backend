<?php

namespace App\Frontend\Common\ResponseTransformer;

use Micro\Plugin\Http\Exception\BadRequestException;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use Symfony\Component\HttpFoundation\Response;

class ResponseExceptionHandler implements ResponseHandlerInterface
{

    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
       $exception = $responseHandlerContext->getException();
       if(!$exception) {
           return;
       }

       if($exception instanceof AMQPTimeoutException) {
           $responseHandlerContext->setResponse(
               new Response('Request timeout', 408)
           );
       }
    }
}