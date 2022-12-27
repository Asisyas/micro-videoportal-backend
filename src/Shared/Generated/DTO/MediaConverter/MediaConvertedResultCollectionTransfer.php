<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\MediaConverter;

use DateTimeInterface;
use Micro\Library\DTO\Object\Collection;

final class MediaConvertedResultCollectionTransfer extends \Micro\Library\DTO\Object\AbstractDto
{
    protected string|null $video_id = null;
    protected iterable|null $results = null;

    public function getVideoId(): string|null
    {
        return $this->video_id;
    }

    public function getResults(): iterable|null
    {
        return $this->results;
    }

    public function setVideoId(string|null $video_id): self
    {
        $this->video_id = $video_id;

        return $this;
    }

    public function setResults(iterable|null $results): self
    {
        if (!$results) {
            $this->results = null;

            return $this;
        }

        if (!$this->results) {
            $this->results = new Collection();
        }

        foreach ($results as $item) {
            $this->results->add($item);
        }

        return $this;
    }

    protected static function attributesMetadata(): array
    {
        return array(
          'video_id' =>
          array(
            'type' =>
            array(
              0 => 'string',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'videoId',
          ),
          'results' =>
          array(
            'type' =>
            array(
              0 => 'iterable',
              1 => 'null',
            ),
            'required' => false,
            'actionName' => 'results',
          ),
        );
    }
}
