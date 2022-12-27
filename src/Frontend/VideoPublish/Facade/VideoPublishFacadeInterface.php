<?php

namespace App\Frontend\VideoPublish\Facade;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface VideoPublishFacadeInterface
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handleVideoPublishRequest(Request $request): Response;
}
