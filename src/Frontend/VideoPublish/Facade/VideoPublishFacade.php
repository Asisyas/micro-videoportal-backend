<?php

namespace App\Frontend\VideoPublish\Facade;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Client\File\FileClientInterface;
use App\Client\Video\Client\VideoClientInterface;
use App\Frontend\VideoPublish\Factory\VideoPublishTransferFactoryInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use Micro\Plugin\Http\Exception\HttpUnprocessableEntityException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoPublishFacade implements VideoPublishFacadeInterface
{
    /**
     * @param VideoPublishTransferFactoryInterface $videoPublishTransferFactory
     * @param VideoClientInterface $videoClient
     * @param FileClientInterface $fileClient
     */
    public function __construct(
        private readonly VideoPublishTransferFactoryInterface $videoPublishTransferFactory,
        private readonly VideoClientInterface $videoClient,
        private readonly FileClientInterface $fileClient
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function handleVideoPublishRequest(Request $request): Response
    {
        $videoPublishTransfer = $this->videoPublishTransferFactory->createFromRequest($request);

        try {
            $ft = new FileGetTransfer();

            $ft->setId($videoPublishTransfer->getFileId());
            $this->fileClient->lookupFile($ft);
        } catch (NotFoundException $exception) {
            throw new HttpUnprocessableEntityException('File not found.', $exception);
        }

        $this->videoClient->videoPublish($videoPublishTransfer);

        return new Response();
    }
}
