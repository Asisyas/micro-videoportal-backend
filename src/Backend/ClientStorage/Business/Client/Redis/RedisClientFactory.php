<?php

namespace App\Backend\ClientStorage\Business\Client\Redis;

use Micro\Plugin\Redis\RedisFacadeInterface;
use App\Backend\ClientStorage\Business\Client\ClientFactoryInterface;
use App\Backend\ClientStorage\Business\Client\ClientInterface;

class RedisClientFactory implements ClientFactoryInterface
{
    /**
     * @param RedisFacadeInterface $redisFacade
     */
    public function __construct(private readonly RedisFacadeInterface $redisFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ClientInterface
    {
        return new RedisClient($this->redisFacade->getClient());
    }
}