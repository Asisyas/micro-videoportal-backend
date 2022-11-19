<?php

namespace App\Frontend\VideoPublish\Factory;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoPublishTransferFactory implements VideoPublishTransferFactoryInterface
{
    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFromRequest(Request $request): FileGetTransfer
    {
        $fileId = $request->query->get('file_id');
        $fileGetTransfer = new FileGetTransfer();

        return $fileGetTransfer
            ->setId($fileId);
    }
}