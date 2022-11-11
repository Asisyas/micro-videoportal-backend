<?php

namespace App\Frontend\VideoPublish\Factory;

use App\Client\File\FileClientInterface;
use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoPublishTransferFactory implements VideoPublishTransferFactoryInterface
{
    /**
     * @param FileClientInterface $fileClient
     * @param ArrayValidatorFactoryInterface $arrayValidatorFactory
     */
    public function __construct(
        private readonly FileClientInterface $fileClient,
        private readonly ArrayValidatorFactoryInterface $arrayValidatorFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFromRequest(Request $request): VideoPublishTransfer
    {
        $jsonContent = json_decode($request->getContent(), true);
        $this->arrayValidatorFactory
            ->create()
            ->validate($jsonContent);

        $videoPublishTransfer = new VideoPublishTransfer();
        $videoPublishTransfer->setFile($this->lookupFile($jsonContent));

        return $videoPublishTransfer;
    }

    /**
     * @param array $requestData
     *
     * @return FileTransfer
     */
    protected function lookupFile(array $requestData): FileTransfer
    {
        $fileGetTransfer = new FileGetTransfer();
        $fileGetTransfer->setId($requestData['file_id']);

        return $this->fileClient->lookupFile($fileGetTransfer);
    }
}