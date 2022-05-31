<?php

namespace App\Client\Category\Configuration;

interface CategoryClientPluginConfigurationInterface
{
    /**
     * @return string
     */
    public function getAmqpCategoryCreatePublisher(): string;

    /**
     * @return string
     */
    public function getAmqpCategoryUpdatePublisher(): string;

    /**
     * @return string
     */
    public function getAmqpCategoryDeletePublisher(): string;
}