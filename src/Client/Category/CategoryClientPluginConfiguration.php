<?php

namespace App\Client\Category;

use App\Client\Category\Configuration\CategoryClientPluginConfigurationInterface;
use App\Shared\Category\Configuration;
use Micro\Framework\Kernel\Configuration\PluginConfiguration;

class CategoryClientPluginConfiguration extends PluginConfiguration implements CategoryClientPluginConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAmqpCategoryCreatePublisher(): string
    {
        return Configuration::AMQP_PUBLISHER_CATEGORY_CREATE;
    }

    /**
     * {@inheritDoc}
     */
    public function getAmqpCategoryDeletePublisher(): string
    {
        return Configuration::AMQP_PUBLISHER_CATEGORY_CREATE;
    }

    /**
     * {@inheritDoc}
     */
    public function getAmqpCategoryUpdatePublisher(): string
    {
        return Configuration::AMQP_PUBLISHER_CATEGORY_CREATE;
    }
}