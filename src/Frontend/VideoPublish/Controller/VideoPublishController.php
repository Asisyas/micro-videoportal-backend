<?php

namespace App\Frontend\VideoPublish\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoPublishController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function publish(Request $request): Response
    {
        return new Response('Hello, world!');
    }
}