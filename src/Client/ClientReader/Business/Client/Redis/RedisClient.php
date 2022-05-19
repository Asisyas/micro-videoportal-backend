<?php

namespace App\Client\ClientReader\Business\Client\Redis;

use App\Client\ClientReader\Business\Client\ClientInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\ClientReader\ResponseTransfer;

class RedisClient implements ClientInterface
{
    /**
     * @param \Redis $redis
     */
    public function __construct(private readonly \Redis $redis)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(RequestTransfer $requestTransfer): ResponseTransfer
    {
        $result = $this->redis->get(
            $requestTransfer->getIndex() . '_' . $requestTransfer->getUuid()
        );

        if(!$result) {
            throw new \Exception(sprintf(
                'Data in the index "%s" with id "%s" is not found', $requestTransfer->getIndex(), $requestTransfer->getUuid()
            ));
        }

        $response = new ResponseTransfer();

        $response->setIndex($requestTransfer->getIndex());
        $response->setUuid($requestTransfer->getUuid());
        $response->setData(json_decode($result, true));

        return $response;
    }
}