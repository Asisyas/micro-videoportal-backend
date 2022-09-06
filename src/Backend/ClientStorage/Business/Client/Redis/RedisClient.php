<?php

namespace App\Backend\ClientStorage\Business\Client\Redis;

use App\Backend\ClientStorage\Business\Client\ClientInterface;
use App\Shared\Generated\DTO\ClientStorage\DeleteTransfer;
use App\Shared\Generated\DTO\ClientStorage\PostTransfer;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use Micro\Library\DTO\Object\AbstractDto;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Redis\Redis\RedisInterface;

class RedisClient implements ClientInterface
{
    public function __construct(
        private readonly RedisInterface $redis,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function put(PutTransfer $putTransfer): void
    {
        $this->redis->set(
            $this->createKey(
                $putTransfer->getUuid(),
                $putTransfer->getIndex()
            ),
            $this->createData($putTransfer->getData())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function post(PostTransfer $postTransfer): void
    {
        $this->redis->set(
            $this->createKey(
                $postTransfer->getUuid(),
                $postTransfer->getIndex()
            ),
            $this->createData($postTransfer->getData())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function delete(DeleteTransfer $deleteTransfer): void
    {
        $this->redis->del(
            $this->createKey(
                $deleteTransfer->getUuid(),
                $deleteTransfer->getIndex()
            )
        );
    }

    /**
     * @param AbstractDto|array|string|int|float $source
     * @return string
     *
     * @throws \Micro\Library\DTO\Exception\SerializeException
     */
    protected function createData(AbstractDto|array|string|int|float $source): string
    {
        if(is_scalar($source)) {
            return $source;
        }

        if($source instanceof AbstractDto) {
            return $this->serializerFacade->toJsonTransfer($source);
        }

        return serialize($source);
    }

    /**
     * @param string $uuid
     * @param string $indexName
     *
     * @return string
     */
    protected function createKey(string $uuid, string $indexName): string
    {
        return $indexName . '_' . $uuid;
    }
}