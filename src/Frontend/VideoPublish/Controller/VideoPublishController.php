<?php

namespace App\Frontend\VideoPublish\Controller;

use App\Frontend\VideoPublish\Facade\VideoPublishFacadeInterface;
use Micro\Plugin\Http\Exception\HttpUnprocessableEntityException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Temporal\Exception\Client\WorkflowExecutionAlreadyStartedException;

class VideoPublishController
{
    /**
     * @param VideoPublishFacadeInterface $videoPublishFacade
     */
    public function __construct(
        private readonly VideoPublishFacadeInterface $videoPublishFacade
    ) {
    }

    /**
     * @param Request $request
     *
     * @return Response
     *
     * @throws HttpUnprocessableEntityException
     */
    public function publish(Request $request): Response
    {
        try {
            return $this->videoPublishFacade->handleVideoPublishRequest($request);
        } catch (WorkflowExecutionAlreadyStartedException $exception) {
            throw new HttpUnprocessableEntityException('Unprocessable entity', $exception);
        }
    }
}
