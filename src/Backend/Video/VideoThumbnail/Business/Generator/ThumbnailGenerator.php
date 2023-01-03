<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Backend\Video\VideoThumbnail\Business\Generator;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoThumbnailGeneratedTransfer;
use App\Shared\Generated\DTO\Video\VideoThumbnailTransfer;
use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ThumbnailGenerator implements ThumbnailGeneratorInterface
{
    /**
     * @param FilesystemOperator $filesystemOperator
     * @param FfmpegFacadeInterface $ffmpegFacade
     */
    public function __construct(
        private readonly FilesystemOperator $filesystemOperator,
        private readonly FfmpegFacadeInterface $ffmpegFacade
    ) {
    }

    /**
     * @param VideoGetTransfer $videoGetTransfer
     * @return VideoThumbnailGeneratedTransfer
     * @throws \League\Flysystem\FilesystemException
     *
     * @throws \Throwable
     */
    public function generateThumbnail(VideoGetTransfer $videoGetTransfer): VideoThumbnailGeneratedTransfer
    {
        $thumbnailOriginFilename = $videoGetTransfer->getVideoId() . '.thumbnail.png';
        $file = '/tmp/' . $thumbnailOriginFilename;

        $parameters = [
            '-i',
            $this->getVideoUrl($videoGetTransfer),
            '-vf',
            'thumbnail=300',
            '-frames:v',
            '1',
            '-vsync',
            'vfr',
            $file
        ];

        $advanced =  $this->ffmpegFacade
            ->ffmpeg()
            ->openAdvanced([])
        ;

        $advanced->setAdditionalParameters($parameters);
        $advanced->save();

        try {
            $thumbnailContent = file_get_contents($file);
            if (!$thumbnailContent) {
                throw new \RuntimeException(sprintf('Thumbnail temp source %s not found', $file));
            }

            $this->filesystemOperator->write($thumbnailOriginFilename, $thumbnailContent);

            return $this->createResponse([$thumbnailOriginFilename]);
        } finally {
            @unlink($file);
        }
    }

    /**
     * @param array $thumbnails
     *
     * @return VideoThumbnailGeneratedTransfer
     */
    protected function createResponse(array $thumbnails): VideoThumbnailGeneratedTransfer
    {
        $result =  new VideoThumbnailGeneratedTransfer();

        foreach ($thumbnails as $source) {
            $thumbnail = new VideoThumbnailTransfer();
            $thumbnail->setSrc($source);

            $result->setResults([$thumbnail]);
        }

        return $result;
    }

    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return string
     */
    protected function getVideoUrl(VideoGetTransfer $videoGetTransfer): string
    {
        return  $this->filesystemOperator
            ->publicUrl($videoGetTransfer->getVideoId());
    }
}
