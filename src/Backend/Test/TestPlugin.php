<?php

namespace App\Backend\Test;

use App\Backend\Channel\VideoChannelPackPlugin;
use App\Backend\MediaConverter\MediaConverterPlugin;
use App\Backend\Video\VideoPackPlugin;
use App\Client\ClientPlugin;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Console\ConsolePlugin;
use Micro\Plugin\DTO\DTOPlugin;
use Micro\Plugin\Locator\LocatorPlugin;
use Micro\Plugin\Security\SecurityPlugin;

class TestPlugin implements PluginDependedInterface
{
    public function getDependedPlugins(): iterable
    {
        return [
            VideoPackPlugin::class,
            VideoChannelPackPlugin::class,
            MediaConverterPlugin::class,
            LocatorPlugin::class,
            SecurityPlugin::class,
            ClientPlugin::class,
            DTOPlugin::class,
            ConsolePlugin::class,
        ];
    }
}
