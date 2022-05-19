<?php

return [
    // Common
    Micro\Plugin\Uuid\UuidPlugin::class,
    Micro\Plugin\Logger\Monolog\MonologPlugin::class,
    Micro\Plugin\EventEmitter\EventEmitterPlugin::class,
    Micro\Plugin\Serializer\SerializerPlugin::class,
    Micro\Plugin\Serializer\Adapter\Symfony\SerializerSymfonyAdapterPlugin::class,
    Micro\Plugin\Redis\RedisPlugin::class,
    Micro\Plugin\Doctrine\DoctrinePlugin::class,
    Micro\Plugin\Console\ConsolePlugin::class,
    Micro\Plugin\User\UserPlugin::class,
    Micro\Plugin\DTO\DTOPlugin::class,

    // Backend
    App\Backend\ClientStorage\ClientStoragePlugin::class,
    App\Backend\Category\CategoryPlugin::class,

    //Client
    App\Client\ClientReader\ClientReaderPlugin::class,
    App\Client\Category\CategoryClientPlugin::class,
];
