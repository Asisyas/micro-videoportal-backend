<?php

namespace App\Frontend\VideoPublish\Controller;

use App\Frontend\VideoPublish\Facade\VideoPublishFacadeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoPublishController
{
    /**
     * @param VideoPublishFacadeInterface $videoPublishFacade
     */
    public function __construct(
        private readonly VideoPublishFacadeInterface $videoPublishFacade
    )
    {
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function publish(Request $request): Response
    {
        return $this->videoPublishFacade->handleVideoPublishRequest($request);
    }
}