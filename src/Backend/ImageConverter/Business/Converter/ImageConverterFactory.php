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

use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ImageConverterFactory implements ImageConverterFactoryInterface
{
    public function __construct(
        private readonly FilesystemFacadeInterface $filesystemFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ImageConverterInterface
    {
        return new ImageConverter(
            $this->filesystemFacade->createFsOperator()
        );
    }
}