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
    App\Backend\File\FilePlugin::class,
    App\Backend\MediaConverter\MediaConverterPlugin::class,
    App\Backend\Test\TestPlugin::class,

    App\Backend\Video\VideoPackPlugin::class,
    App\Backend\Channel\VideoChannelPackPlugin::class,

];

$pluginsCommon = [
    // Common
    Micro\Plugin\Logger\Monolog\MonologPlugin::class,
    Micro\Plugin\Configuration\Helper\ConfigurationHelperPlugin::class,
    Micro\Plugin\Locator\LocatorPlugin::class,
    Micro\Plugin\Filesystem\Adapter\Aws\FilesystemS3AdapterPlugin::class,
    App\Shared\FsOperatorDecorator\FsOperatorDecoratorPlugin::class,

    Micro\Plugin\Security\SecurityPlugin::class,

    App\Shared\Config\ConfigPlugin::class,

    Micro\Plugin\Console\ConsolePlugin::class,

    App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\VideoTransferExpanderPlugin::class,
];

$pluginClients = [
    App\Client\ClientPlugin::class,
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
