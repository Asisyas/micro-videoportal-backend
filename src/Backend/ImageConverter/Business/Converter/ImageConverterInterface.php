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

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface ImageConverterInterface
{
    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return void
     */
    public function convert(FileGetTransfer $fileGetTransfer): void;
}