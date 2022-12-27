<?php

namespace App\Backend\MediaConverter\Business\Dash;

use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class DashManifestGeneratorFactory implements DashManifestGeneratorFactoryInterface
{
    /**
     * @param FilesystemFacadeInterface $filesystemFacade
     * @param FfmpegFacadeInterface $ffmpegFacade
     */
    public function __construct(
        private readonly FilesystemFacadeInterface $filesystemFacade,
        private readonly FfmpegFacadeInterface $ffmpegFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): DashManifestGeneratorInterface
    {
        return new DashManifestGenerator(
            $this->filesystemFacade->createFsOperator(),
            $this->ffmpegFacade,
        );
    }
}
