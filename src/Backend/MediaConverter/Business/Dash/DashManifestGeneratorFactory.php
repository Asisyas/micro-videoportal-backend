<?php

namespace App\Backend\MediaConverter\Business\Dash;

use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class DashManifestGeneratorFactory implements DashManifestGeneratorFactoryInterface
{
    public function __construct(
        private readonly FilesystemFacadeInterface $filesystemFacade,
        private readonly FfmpegFacadeInterface $ffmpegFacade
    )
    {
    }

    public function create(): DashManifestGeneratorInterface
    {
        return new DashManifestGenerator(
            $this->filesystemFacade->createFsOperator(),
            $this->ffmpegFacade,
        );
    }
}