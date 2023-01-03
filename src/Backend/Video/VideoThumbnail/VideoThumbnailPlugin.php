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

namespace App\Backend\Video\VideoThumbnail;

use App\Backend\Video\VideoThumbnail\Business\Generator\ThumbnailGeneratorFactory;
use App\Backend\Video\VideoThumbnail\Facade\VideoThumbnailFacade;
use App\Backend\Video\VideoThumbnail\Facade\VideoThumbnailFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Ffmpeg\FfmpegPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Filesystem\FilesystemPlugin;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoThumbnailPlugin implements PluginDependedInterface, DependencyProviderInterface
{
    private readonly FilesystemFacadeInterface $filesystemFacade;

    /**
     * @var FfmpegFacadeInterface
     */
    private readonly FfmpegFacadeInterface $ffmpegFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoThumbnailFacadeInterface::class, function (
            FilesystemFacadeInterface $filesystemFacade,
            FfmpegFacadeInterface $ffmpegFacade
        ) {
            $this->filesystemFacade = $filesystemFacade;
            $this->ffmpegFacade = $ffmpegFacade;

            return $this->createFacade();
        });
    }
    /**
     * {@inheritDoc}
     */
    public function getDependedPlugins(): iterable
    {
        return [
            FilesystemPlugin::class,
            FfmpegPlugin::class,
        ];
    }


    /**
     * @return VideoThumbnailFacadeInterface
     */
    protected function createFacade(): VideoThumbnailFacadeInterface
    {
        return new VideoThumbnailFacade(
            $this->createThumbnailGeneratorFactory()
        );
    }

    /**
     * @return ThumbnailGeneratorFactory
     */
    protected function createThumbnailGeneratorFactory()
    {
        return new ThumbnailGeneratorFactory(
            $this->filesystemFacade,
            $this->ffmpegFacade,
        );
    }
}
