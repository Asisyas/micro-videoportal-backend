<?php

$isCli = php_sapi_name() == 'cli';

$pluginsFront = [
    Micro\Plugin\Http\HttpPlugin::class,
    Micro\Plugin\Http\Security\HttpSecurityPlugin::class,
    App\Frontend\File\FilePlugin::class,
    App\Frontend\VideoPublish\VideoPublishPlugin::class,
    App\Saga\VideoUpload\VideoUploadSagaPlugin::class
];

$pluginsBack = [
    // Task Status Storage writer
    Micro\Plugin\Amqp\TaskStatus\Storage\AmqpTaskStatusStoragePlugin::class,
    Micro\Plugin\Amqp\TaskStatus\Storage\Doctrine\AmqpTaskStatusStorageDoctrinePlugin::class,

    Micro\Plugin\User\Model\Doctrine\UserModelDoctrinePlugin::class,
    Micro\Plugin\User\Manager\Doctrine\UserManagerDoctrinePlugin::class,

    Micro\Plugin\Console\ConsolePlugin::class,
    /* Video converter FFMPEG */
    Micro\Plugin\Ffmpeg\FfmpegPlugin::class,

    /*  APPLICATION PLUGINS */
    // Backend
    App\Backend\ClientStorage\ClientStoragePlugin::class,
    App\Backend\File\FilePlugin::class,
    App\Backend\VideoConverter\VideoConverterPlugin::class,

    App\Backend\Test\TestPlugin::class,

];

$pluginsCommon = [
    // Common
    Micro\Plugin\Uuid\UuidPlugin::class,
    Micro\Plugin\Logger\Monolog\MonologPlugin::class,
    Micro\Plugin\EventEmitter\EventEmitterPlugin::class,
    Micro\Plugin\Serializer\SerializerPlugin::class,
    Micro\Plugin\Serializer\Adapter\Symfony\SerializerSymfonyAdapterPlugin::class,
    Micro\Plugin\Redis\RedisPlugin::class,
    Micro\Plugin\DTO\DTOPlugin::class,
    Micro\Plugin\Configuration\Helper\ConfigurationHelperPlugin::class,
    Micro\Plugin\Locator\LocatorPlugin::class,
    Micro\Plugin\Filesystem\FilesystemPlugin::class,

    Micro\Plugin\Security\SecurityPlugin::class,
    /*  AMQP */
    // Core services for consume/produce
    Micro\Plugin\Amqp\AmqpPlugin::class,

    Micro\Plugin\Doctrine\DoctrinePlugin::class,

    // Task Status Client reader
    Micro\Plugin\Amqp\TaskStatus\Client\AmqpTaskStatusClientPlugin::class,
    Micro\Plugin\Amqp\TaskStatus\Client\Doctrine\AmqpTaskStatusClientDoctrinePlugin::class,

    // SAGA
    Micro\Plugin\Temporal\TemporalPlugin::class,

    App\Saga\VideoPublish\VideoPublishPlugin::class,
];

$pluginClients = [
    App\Client\Amqp\AmqpClientPlugin::class,
    App\Client\ClientReader\ClientReaderPlugin::class,
    App\Client\File\FilePlugin::class,
    App\Client\VideoPublish\VideoPublishPlugin::class,
];

return array_merge($pluginsCommon, $pluginClients, ($isCli ?  $pluginsBack: $pluginsFront));
