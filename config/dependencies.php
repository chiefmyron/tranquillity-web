<?php declare(strict_types=1);

// Library classes
use DI\ContainerBuilder;

// Application classes
use Tranquillity\Config\Config;
use Tranquillity\ServiceProvider\LoggerServiceProvider;
use Tranquillity\ServiceProvider\ViewServiceProvider;

return static function (ContainerBuilder $containerBuilder, Config $config) {
    // Add configuration to container
    $containerBuilder->addDefinitions(['config' => $config]);

    // Use application service providers to register additional dependencies
    $serviceProviders = [
        LoggerServiceProvider::class,
        ViewServiceProvider::class
    ];
    foreach ($serviceProviders as $providerClassname) {
        $provider = new $providerClassname();
        $provider->register($containerBuilder);
    }
};