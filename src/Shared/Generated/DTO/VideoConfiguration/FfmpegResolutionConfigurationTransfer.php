<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\VideoConfiguration;

use DateTimeInterface;

final class FfmpegResolutionConfigurationTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected int $minrate;
    protected int $maxrate;
    protected int $tile_columns;
    protected int $threads;
    protected int $crf;
    protected string $hwaccel;
    protected int $speed;

    public function getMinrate(): int
    {
        return $this->minrate;
    }

    public function getMaxrate(): int
    {
        return $this->maxrate;
    }

    public function getTileColumns(): int
    {
        return $this->tile_columns;
    }

    public function getThreads(): int
    {
        return $this->threads;
    }

    public function getCrf(): int
    {
        return $this->crf;
    }

    public function getHwaccel(): string
    {
        return $this->hwaccel;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function setMinrate(int $minrate): self
    {
        $this->minrate = $minrate;

        return $this;
    }

    public function setMaxrate(int $maxrate): self
    {
        $this->maxrate = $maxrate;

        return $this;
    }

    public function setTileColumns(int $tile_columns): self
    {
        $this->tile_columns = $tile_columns;

        return $this;
    }

    public function setThreads(int $threads): self
    {
        $this->threads = $threads;

        return $this;
    }

    public function setCrf(int $crf): self
    {
        $this->crf = $crf;

        return $this;
    }

    public function setHwaccel(string $hwaccel): self
    {
        $this->hwaccel = $hwaccel;

        return $this;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'minrate' =>
          array(
            'type' =>
            array(
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'minrate',
          ),
          'maxrate' =>
          array(
            'type' =>
            array(
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'maxrate',
          ),
          'tile_columns' =>
          array(
            'type' =>
            array(
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'tileColumns',
          ),
          'threads' =>
          array(
            'type' =>
            array(
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'threads',
          ),
          'crf' =>
          array(
            'type' =>
            array(
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'crf',
          ),
          'hwaccel' =>
          array(
            'type' =>
            array(
              0 => 'string',
            ),
            'required' => true,
            'actionName' => 'hwaccel',
          ),
          'speed' =>
          array(
            'type' =>
            array(
              0 => 'int',
            ),
            'required' => true,
            'actionName' => 'speed',
          ),
        );
    }
}
