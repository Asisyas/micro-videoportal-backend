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

namespace App\Backend\ImageConverter\Business\Converter;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ImageConverter implements ImageConverterInterface
{
    public function __construct(
        private readonly FilesystemOperator $filesystemOperator
    )
    {
    }

    public function convert(FileGetTransfer $fileGetTransfer): void
    {
        $fileId = $fileGetTransfer->getId();
        $filePublicUrl = $this->filesystemOperator->publicUrl($fileId);

        $resource = imagecreatefromgd($filePublicUrl);
        if($resource === false) {
            throw new \RuntimeException('File is not valid image.');
        }

        $tmpResource = tmpfile();

        if(!imagewebp($resource, $tmpResource)) {
            fclose($tmpResource);
            throw new \RuntimeException('File is not valid image.');
        }

        try {
            $this->filesystemOperator->writeStream($fileId . '.webp', $tmpResource);
        } catch (\Throwable $exception) {
            throw new \RuntimeException($exception->getMessage());
        } finally {
            fclose($tmpResource);
        }
    }
}