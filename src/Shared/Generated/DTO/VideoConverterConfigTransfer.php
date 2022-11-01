<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\Video\SourceFileMetadataTransfer;
use DateTimeInterface;

final class VideoConverterConfigTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected FileTransfer|null $file = null;
    protected SourceFileMetadataTransfer|null $metadata = null;
    protected ResolutionTransfer|null $resolution = null;

    public function getFile(): FileTransfer|null
    {
        return $this->file;
    }

    public function getMetadata(): SourceFileMetadataTransfer|null
    {
        return $this->metadata;
    }

    public function getResolution(): ResolutionTransfer|null
    {
        return $this->resolution;
    }

    public function setFile(FileTransfer|null $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setMetadata(SourceFileMetadataTransfer|null $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setResolution(ResolutionTransfer|null $resolution): self
    {
        $this->resolution = $resolution;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array (
          'file' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\File\\FileTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'file',
          ),
          'metadata' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Video\\SourceFileMetadataTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'metadata',
          ),
          'resolution' =>
          array (
            'type' =>
            array (
              0 => 'App\\Shared\\Generated\\DTO\\Video\\ResolutionTransfer',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'resolution',
          ),
        );
    }
}
