<?php

$pluginsFront = [
    Micro\Plugin\Http\HttpPlugin::class,

    App\Frontend\Security\SecurityPlugin::class,

    App\Frontend\File\FilePlugin::class,

    App\Frontend\VideoPublish\VideoPublishPlugin::class,
    App\Frontend\VideoWatch\VideoWatchPlugin::class,
    App\Frontend\VideoSearch\VideoSearchPlugin::class,
    App\Frontend\VideoChannel\VideoChannelPlugin::class,

    Micro\Plugin\OAuth2\Client\OAuth2ClientPlugin::class,
    Micro\Plugin\OAuth2\Client\Keycloak\OAuth2KeycloakProviderPlugin::class,
];

$pluginsBack = [
    Micro\Plugin\Doctrine\DoctrinePlugin::class,
    Micro\Plugin\Console\ConsolePlugin::class,
    /* Video converter FFMPEG */
    Micro\Plugin\Ffmpeg\FfmpegPlugin::class,

    /*  APPLICATION PLUGINS */
    // Backend
    App\Backend\ClientStorage\ClientStoragePlugin::class,
    App\Backend\File\FilePlugin::class,
    App\Backend\MediaConverter\MediaConverterPlugin::class,

    App\Backend\Test\TestPlugin::class,

    App\Backend\SearchStorage\SearchStoragePlugin::class,

    /** Video Plugins */
    App\Backend\Video\VideoPlugin::class,
    App\Backend\VideoPublish\VideoPublishPlugin::class,
    App\Backend\VideoDescription\VideoDescriptionPlugin::class,
    App\Backend\VideoChannel\VideoChannelPlugin::class,

];

$pluginsCommon = [
    // Common
    Micro\Plugin\Uuid\UuidPlugin::class,
    Micro\Plugin\Logger\Monolog\MonologPlugin::class,
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
    App\Client\VideoChannel\VideoChannelClientPlugin::class,
    App\Client\Security\SecurityClientPlugin::class,
];


const ENV_MODE_FRONT = 'frontend';
const ENV_MODE_BACK = 'backend';

$envs = explode(',', getenv('APP_MODE') ?: ENV_MODE_FRONT . ',' . ENV_MODE_BACK);

$plugins = array_merge($pluginsCommon, $pluginClients);

if(in_array(ENV_MODE_FRONT, $envs)) {
    $plugins = array_merge($plugins,  $pluginsFront);
}

if(in_array(ENV_MODE_BACK, $envs)) {
    $plugins = array_merge($plugins,  $pluginsBack);
}

return $plugins;
