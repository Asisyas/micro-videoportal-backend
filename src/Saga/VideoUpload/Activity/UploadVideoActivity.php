<?php

namespace App\Saga\VideoUpload\Activity;

use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\Video\SourceFileMetadataTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Generated\DTO\VideoConverterConfigTransfer;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;

class UploadVideoActivity implements UploadVideoActivityInterface
{

    public function __construct(
        private readonly FileClientInterface $fileClient,
        private readonly FfmpegFacadeInterface $ffmpegFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookupSourceFile(FileGetTransfer $fileGetTransfer): FileTransfer
    {
        return $this->fileClient->lookupFile($fileGetTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function extractVideoMetadata(FileTransfer $fileTransfer): SourceFileMetadataTransfer
    {
        return (new SourceFileMetadataTransfer())
            ->setFormat($fileTransfer->getContentType())
            ->setLength($fileTransfer->getSize())
            ->setName($fileTransfer->getName())
            ->setResolution([
                (new ResolutionTransfer())
                    ->setFps(60)
                    ->setHeight(720)
                    ->setWidth(1024)
            ])
            ;
    }

    public function convertVideo(VideoConverterConfigTransfer $videoConverterConfigTransfer): array
    {
        return [
            'file' => $videoConverterConfigTransfer->getFile()->getId(),
            'resolution'   => [
                'fps'   => $videoConverterConfigTransfer->getResolution()->getFps(),
                'resolution' => $videoConverterConfigTransfer->getResolution()->getHeight(),
            ]
        ];
    }

    public function removeInvalidSourceFile(FileTransfer $fileTransfer): void
    {
    }
}