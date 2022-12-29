<?php

namespace App\Frontend\VideoPublish\Facade;

use Micro\Plugin\Http\Exception\HttpUnprocessableEntityException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Temporal\Exception\Client\WorkflowExecutionAlreadyStartedException;

interface VideoPublishFacadeInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws HttpUnprocessableEntityException
     * @throws WorkflowExecutionAlreadyStartedException
     */
    public function handleVideoPublishRequest(Request $request): Response;
}
