<?php

$isCli = php_sapi_name() == 'cli';

$pluginsFront = [
    Micro\Plugin\Http\HttpPlugin::class,
    Micro\Plugin\Http\Security\HttpSecurityPlugin::class,
    App\Frontend\File\FilePlugin::class,
    App\Frontend\VideoPublish\VideoPublishPlugin::class,
    App\Frontend\VideoWatch\VideoWatchPlugin::class,
];

$pluginsBack = [
    Micro\Plugin\Doctrine\DoctrinePlugin::class,

    Micro\Plugin\User\Model\Doctrine\UserModelDoctrinePlugin::class,
    Micro\Plugin\User\Manager\Doctrine\UserManagerDoctrinePlugin::class,

    Micro\Plugin\Console\ConsolePlugin::class,
    /* Video converter FFMPEG */
    Micro\Plugin\Ffmpeg\FfmpegPlugin::class,

    /*  APPLICATION PLUGINS */
    // Backend
    App\Backend\ClientStorage\ClientStoragePlugin::class,
    App\Backend\File\FilePlugin::class,
    App\Backend\MediaConverter\MediaConverterPlugin::class,

    App\Backend\Test\TestPlugin::class,
    App\Backend\Video\VideoPlugin::class,
    App\Backend\VideoDescription\VideoDescriptionPlugin::class,

    App\Backend\SearchStorage\SearchStoragePlugin::class,

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
    Micro\Plugin\Filesystem\Adapter\Aws\FilesystemS3AdapterPlugin::class,
    App\Shared\FsOperatorDecorator\FsOperatorDecoratorPlugin::class,
    Micro\Plugin\Elastic\ElasticPlugin::class,

    Micro\Plugin\Security\SecurityPlugin::class,

    // SAGA
    Micro\Plugin\Temporal\TemporalPlugin::class,

    App\Backend\Saga\SagaPlugin::class,
    App\Client\Video\VideoClientPlugin::class,
];

$pluginClients = [
    App\Client\ClientReader\ClientReaderPlugin::class,
    App\Client\File\FilePlugin::class,
    App\Client\Search\SearchClientPlugin::class,
];

return array_merge($pluginsCommon, $pluginClients, ($isCli ?  $pluginsBack: $pluginsFront));
