<?php

namespace App\Backend\ClientStorage\Business\Client\Redis;

use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Backend\ClientStorage\Business\Client\ClientFactoryInterface;
use App\Backend\ClientStorage\Business\Client\ClientInterface;

class RedisClientFactory implements ClientFactoryInterface
{
    /**
     * @param RedisFacadeInterface $redisFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly RedisFacadeInterface $redisFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
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