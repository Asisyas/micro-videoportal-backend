<?php

namespace App\Client\Category\Business\Manager;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;

class CategoryManager implements CategoryManagerInterface
{
    /**
     * @param AmqpClientInterface $amqpClient
     * @param string $publisherName
     */
    public function __construct(
        private readonly AmqpClientInterface $amqpClient,
        private readonly string $publisherName
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(CategoryCreateTransfer $categoryCreateTransfer): ResponseTransfer
    {
        $request = new RequestTransfer();

        $request->setMessage($categoryCreateTransfer);
        $request->setPublisher($this->publisherName);

        return $this->amqpClient->publish($request);
    }
}