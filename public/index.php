<?php

$basedir = realpath(__DIR__ . '/../');

require $basedir . '/vendor/autoload.php';

$applicationConfiguration = include $basedir . '/etc/config_settings.php';

$kernel = new \Micro\Kernel\App\AppKernel(
    $applicationConfiguration,
    include $basedir . '/etc/plugins.php',
    'dev'
);

$kernel->run();

$kernel->terminate();
