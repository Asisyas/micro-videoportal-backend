<?php

namespace App\Client\Category\Business\Manager;

use App\Client\Amqp\Client\AmqpClientInterface;

class CategoryManagerFactory implements CategoryManagerFactoryInterface
{
    /**
     * @param AmqpClientInterface $amqpClient
     * @param string $amqpPublisherCategoryCreate
     */
    public function __construct(
        private readonly AmqpClientInterface $amqpClient,
        private readonly string $amqpPublisherCategoryCreate,
        private readonly string $amqpPublisherCategoryUpdate,
        private readonly string $amqpPublisherCategoryDelete
    )
    {
    }

    /**
     * @return CategoryManagerInterface
     */
    public function create(): CategoryManagerInterface
    {
        return new CategoryManager(
            $this->amqpClient,
            $this->amqpPublisherCategoryCreate
        );
    }
}