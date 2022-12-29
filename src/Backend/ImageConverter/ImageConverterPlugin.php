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

namespace App\Backend\ImageConverter;

use App\Backend\ImageConverter\Business\Converter\ImageConverterFactory;
use App\Backend\ImageConverter\Business\Converter\ImageConverterFactoryInterface;
use App\Backend\ImageConverter\Facade\ImageConverterFacade;
use App\Backend\ImageConverter\Facade\ImageConverterFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ImageConverterPlugin implements DependencyProviderInterface
{
    /**
     * @var FilesystemFacadeInterface
     */
    private readonly FilesystemFacadeInterface $filesystemFacade;

    public function provideDependencies(Container $container): void
    {
        $container->register(ImageConverterFacadeInterface::class, function (
            FilesystemFacadeInterface $filesystemFacade
        ) {
            $this->filesystemFacade = $filesystemFacade;

            return $this->createFacade();
        });
    }

    protected function createFacade(): ImageConverterFacade
    {
        return new ImageConverterFacade(
            $this->createImageConverterFactory()
        );
    }

    protected function createImageConverterFactory(): ImageConverterFactory
    {
        return new ImageConverterFactory($this->filesystemFacade);
    }
}
