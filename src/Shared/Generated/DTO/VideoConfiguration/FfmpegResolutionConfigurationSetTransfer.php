<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConfiguration;

use DateTimeInterface;

final class FfmpegResolutionConfigurationSetTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected ResolutionTransfer $resolution;
    protected FfmpegResolutionConfigurationTransfer $configuration;

    public function getResolution(): ResolutionTransfer
    {
        return $this->resolution;
    }

    public function getConfiguration(): FfmpegResolutionConfigurationTransfer
    {
        return $this->configuration;
    }

    public function setResolution(ResolutionTransfer $resolution): self
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function setConfiguration(FfmpegResolutionConfigurationTransfer $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'resolution' =>
          array(
            'type' =>
            array(
              0 => 'App\\Shared\\Generated\\DTO\\VideoConfiguration\\ResolutionTransfer',
            ),
            'required' => true,
            'actionName' => 'resolution',
          ),
          'configuration' =>
          array(
            'type' =>
            array(
              0 => 'App\\Shared\\Generated\\DTO\\VideoConfiguration\\FfmpegResolutionConfigurationTransfer',
            ),
            'required' => true,
            'actionName' => 'configuration',
          ),
        );
    }
}
