<?php

namespace App\Frontend\Common\ResponseTransformer;

use Micro\Library\DTO\Object\AbstractDto;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseTransformerHandler implements ResponseHandlerInterface
{
    public function __construct(private readonly SerializerFacadeInterface $serializerFacade)
    {
    }

    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $responseData = $responseHandlerContext->getResponse();
        if(!($responseData instanceof AbstractDto)) {
            return;
        }

        $response = new JsonResponse($this->serializerFacade->toArray($responseData));

        $responseHandlerContext->setResponse($response);
    }
}