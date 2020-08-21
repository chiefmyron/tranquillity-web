<?php

declare(strict_types=1);

// Library classes
use DI\ContainerBuilder;

// Application classes
use Tranquility\App\Config;

return static function (ContainerBuilder $containerBuilder, Config $config) {
    // Add configuration to container
    $containerBuilder->addDefinitions(['config' => $config]);
    if ($config->has('settings')) {
        $containerBuilder->addDefinitions(['settings' => $config->get('settings')]);
    }

    // Register service providers
    $services = $config->get('app.service_providers', []);
    foreach ($services as $name => $class) {
        $service = new $class();
        $service->register($containerBuilder, $name);
    }
};