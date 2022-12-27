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

namespace App\Backend\ImageConverter\Facade;

use App\Backend\ImageConverter\Business\Converter\ImageConverterFactoryInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ImageConverterFacade implements ImageConverterFacadeInterface
{
    /**
     * @param ImageConverterFactoryInterface $imageConverterFactory
     */
    public function __construct(
        private readonly ImageConverterFactoryInterface $imageConverterFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function convert(FileGetTransfer $fileGetTransfer): void
    {
        $this->imageConverterFactory
            ->create()
            ->convert($fileGetTransfer);
    }
}