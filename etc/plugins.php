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
    Micro\Plugin\User\Model\Doctrine\UserModelDoctrinePlugin::class,
    Micro\Plugin\User\Manager\Doctrine\UserManagerDoctrinePlugin::class,
    Micro\Plugin\DTO\DTOPlugin::class,
    Micro\Plugin\Http\HttpPlugin::class,
    Micro\Plugin\Configuration\Helper\ConfigurationHelperPlugin::class,

    /* Security */
    Micro\Plugin\Security\SecurityPlugin::class,
    Micro\Plugin\Http\Security\HttpSecurityPlugin::class,

    /*  AMQP */
    // Core services for consume/produce
    Micro\Plugin\Amqp\AmqpPlugin::class,

    // Task Status Storage writer
    Micro\Plugin\Amqp\TaskStatus\Storage\AmqpTaskStatusStoragePlugin::class,
    Micro\Plugin\Amqp\TaskStatus\Storage\Doctrine\AmqpTaskStatusStorageDoctrinePlugin::class,

    // Task Status Client reader
    Micro\Plugin\Amqp\TaskStatus\Client\AmqpTaskStatusClientPlugin::class,
    Micro\Plugin\Amqp\TaskStatus\Client\Doctrine\AmqpTaskStatusClientDoctrinePlugin::class,

    /*  APPLICATION PLUGINS */
    // Backend
    App\Backend\ClientStorage\ClientStoragePlugin::class,
    App\Backend\Category\CategoryPlugin::class,
    App\Backend\User\UserPlugin::class,
    App\Backend\File\FilePlugin::class,

    //Client
    App\Client\Amqp\AmqpClientPlugin::class,
    App\Client\ClientReader\ClientReaderPlugin::class,
    App\Client\Category\CategoryClientPlugin::class,
    App\Client\User\UserClientPlugin::class,
    App\Client\File\FilePlugin::class,

    //Front
    App\Frontend\Category\CategoryFrontPlugin::class,
    App\Frontend\User\UserFrontPlugin::class,
    App\Frontend\File\FilePlugin::class,
];
