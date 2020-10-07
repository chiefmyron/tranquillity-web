<?php declare(strict_types=1);

// Library classes
use DI\ContainerBuilder;

// Application classes
use Tranquillity\Config\Config;
use Tranquillity\ServiceProvider\DatabaseServiceProvider;
use Tranquillity\ServiceProvider\FormServiceProvider;
use Tranquillity\ServiceProvider\LoggerServiceProvider;
use Tranquillity\ServiceProvider\ProfilerServiceProvider;
use Tranquillity\ServiceProvider\TranslationServiceProvider;
use Tranquillity\ServiceProvider\ViewServiceProvider;

return static function (ContainerBuilder $containerBuilder, Config $config) {
    // Add configuration to container
    $containerBuilder->addDefinitions(['config' => $config]);

    // Use application service providers to register additional dependencies
    $serviceProviders = [
        LoggerServiceProvider::class,
        ProfilerServiceProvider::class,
        DatabaseServiceProvider::class,
        ViewServiceProvider::class,
        TranslationServiceProvider::class,
        FormServiceProvider::class
    ];
    foreach ($serviceProviders as $providerClassname) {
        $provider = new $providerClassname();
        $provider->register($containerBuilder);
    }
};