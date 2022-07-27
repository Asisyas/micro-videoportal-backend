<?php

namespace App\Shared\User;

final class Configuration
{
    public const AMQP_PUBLISHER_USER_CREATE = 'user_create';
    public const AMQP_CONSUMER_USER_CREATE = 'user_create';

    public const ROLE_USER = 'user';
}