<?php

namespace App\Client\ClientReader\Business\Client\Redis;

use App\Client\ClientReader\Business\Client\ClientInterface;
use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\ClientReader\ResponseTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Redis\Redis\RedisInterface;

class RedisClient implements ClientInterface
{
    /**
     * @param RedisInterface $redis
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly RedisInterface $redis,
        private readonly SerializerFacadeInterface $serializerFacade
    )
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
            throw new NotFoundException(sprintf(
                'Data in the index "%s" with id "%s" is not found', $requestTransfer->getIndex(), $requestTransfer->getUuid()
            ));
        }

        $response = new ResponseTransfer();

        $response->setIndex($requestTransfer->getIndex());
        $response->setUuid($requestTransfer->getUuid());
        $response->setData($this->serializerFacade->fromJsonTransfer($result));

        return $response;
    }
}