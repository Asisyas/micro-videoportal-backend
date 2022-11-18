<?php

namespace App\Frontend\Common\ResponseTransformer;

use App\Client\ClientReader\Exception\NotFoundException as ClientReaderNotFoundException;
use Micro\Plugin\Http\Exception\BadRequestException;
use Micro\Plugin\Http\Exception\HttpNotFoundException;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ResponseExceptionHandler implements ResponseHandlerInterface
{
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
       $exception = $responseHandlerContext->getException();
       if(!$exception) {
           return;
       }

       if($exception instanceof BadRequestException) {
           $sourceConstraintsViolations = $exception->getSource();
           $message = $exception->getMessage();
           $response = new Response('', 400);
           if($sourceConstraintsViolations !== null) {
                $message = json_encode($this->buildMessage($sourceConstraintsViolations));
                $response->headers->set('Content-Type', 'application/json');
           }

           $responseHandlerContext->setResponse(
               $response->setContent($message)
           );

           return;
       }

       if($exception instanceof ClientReaderNotFoundException) {
           $responseHandlerContext->setException(
               new HttpNotFoundException($exception->getMessage())
           );
       }

       if($exception instanceof AMQPTimeoutException) {
           $responseHandlerContext->setResponse(
               new Response('Request timeout', 408)
           );
       }
    }

    public function buildMessage(ConstraintViolationListInterface $violations): array
    {
        $errors = [];

        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $errors [
                rtrim(ltrim($violation->getPropertyPath(), '['), ']')
            ] = $violation->getMessage();
        }


        return $errors;
    }
}