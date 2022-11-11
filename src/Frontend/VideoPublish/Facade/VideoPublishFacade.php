<?php

namespace App\Frontend\VideoPublish\Facade;

use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoPublishFacade implements VideoPublishFacadeInterface
{
    /**
     * @param VideoPublishTransferFactoryInterface $videoPublishTransferFactory
     */
    public function __construct(
        private readonly VideoPublishTransferFactoryInterface $videoPublishTransferFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createVideoPublishTransferFromRequest(Request $request): VideoPublishTransfer
    {
        return $this->videoPublishTransferFactory->createFromRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    public function handleVideoPublishRequest(Request $request): Response
    {
        return new Response('Hello, world!');
    }
}