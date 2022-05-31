<?php

namespace App\Shared\Category;

interface Configuration
{
    public const CLIENT_READER_INDEX = 'category';

    public const SERVICE_FACADE_BACKEND = 'app.category.facade.back';

    public const SERVICE_FACADE_FRONTEND = 'app.category.facade.front';

    public const AMQP_PUBLISHER_CATEGORY_CREATE = 'category_create';

    public const AMQP_CONSUMER_CATEGORY = 'category';
}