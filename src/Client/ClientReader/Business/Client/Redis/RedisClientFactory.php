<?php

namespace App\Client\ClientReader\Business\Client\Redis;

use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Client\ClientReader\Business\Client\ClientFactoryInterface;
use App\Client\ClientReader\Business\Client\ClientInterface;

class RedisClientFactory implements ClientFactoryInterface
{
    public function __construct(
        private readonly RedisFacadeInterface $redisFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ClientInterface
    {
        return new RedisClient(
            $this->redisFacade->getClient(),
            $this->serializerFacade
        );
    }
}
