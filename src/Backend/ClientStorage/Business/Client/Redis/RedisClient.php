<?php

namespace App\Backend\ClientStorage\Business\Client\Redis;

use App\Backend\ClientStorage\Business\Client\ClientInterface;
use App\Shared\Generated\DTO\ClientStorage\DeleteTransfer;
use App\Shared\Generated\DTO\ClientStorage\PostTransfer;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use Micro\Library\DTO\Object\AbstractDto;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Redis\Redis\RedisInterface;

readonly class RedisClient implements ClientInterface
{
    public function __construct(
        private RedisInterface            $redis,
        private SerializerFacadeInterface $serializerFacade
    ) {
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
     * @param mixed $source
     * @return string
     *
     * @throws \Micro\Library\DTO\Exception\SerializeException
     */
    protected function createData(mixed $source): string
    {
        if (!($source instanceof AbstractDto)) {
            return $source;
        }

        return $this->serializerFacade->toJsonTransfer($source);
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
