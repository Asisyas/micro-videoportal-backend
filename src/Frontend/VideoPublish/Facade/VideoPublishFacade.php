<?php

namespace App\Frontend\VideoPublish\Facade;

use App\Client\Video\Client\VideoClientInterface;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoPublishFacade implements VideoPublishFacadeInterface
{
    /**
     * @param VideoPublishTransferFactoryInterface $videoPublishTransferFactory
     * @param VideoClientInterface $videoClient
     */
    public function __construct(
        private readonly VideoPublishTransferFactoryInterface $videoPublishTransferFactory,
        private readonly VideoClientInterface $videoClient
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function handleVideoPublishRequest(Request $request): Response
    {
        $videoPublishTransfer = $this->videoPublishTransferFactory->createFromRequest($request);

        $this->videoClient->videoPublish($videoPublishTransfer);

        return new Response();
    }
}
