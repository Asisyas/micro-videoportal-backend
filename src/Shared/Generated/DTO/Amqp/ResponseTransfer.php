<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

namespace App\Shared\Generated\DTO\Amqp;

use Micro\Library\DTO\Object\AbstractDto;

final class ResponseTransfer extends AbstractDto
{
    /**
     * @var string|null
     */
    protected string|null $channel_id;

    /**
     * @return string|null
     */
    public function getChannelId(): string|null
    {
        return $this->channel_id;
    }

    /**
     * @param string|null $channel_id
     *
     * @return ResponseTransfer
     */
    public function setChannelId(string|null $channel_id): self
    {
        $this->channel_id = $channel_id;

         return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected static function attributesMetadata(): array
    {
        return array (
          'channel_id' =>
          array (
            'is_collection' => false,
            'type' => 'string',
            'actionName' => 'ChannelId',
            'required' => 'true',
          ),
        );
    }
}
