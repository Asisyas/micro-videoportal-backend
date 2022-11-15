<?php

namespace App\Backend\MediaConverter\Business\Dash;

interface DashManifestGeneratorFactoryInterface
{
    /**
     * @return DashManifestGeneratorInterface
     */
    public function create(): DashManifestGeneratorInterface;
}