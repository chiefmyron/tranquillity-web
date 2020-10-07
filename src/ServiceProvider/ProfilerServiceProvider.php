<?php namespace Tranquillity\ServiceProvider;

// PSR standards interfaces
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

// Library classes
use DI\ContainerBuilder;
use Doctrine\DBAL\Connection;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig\Extension\ProfilerExtension;
use Twig\Profiler\Profile;

// Application classes
use Tranquillity\Utility\ArrayHelper;
use Tranquillity\Utility\Profiler\Profiler;
use Tranquillity\Utility\Profiler\Storage\FileProfilerStorage;
use Tranquillity\Utility\Profiler\DataCollector\DatabaseDataCollector;
use Tranquillity\Utility\Profiler\DataCollector\EnvironmentDataCollector;
use Tranquillity\Utility\Profiler\DataCollector\HttpDataCollector;
use Tranquillity\Utility\Profiler\DataCollector\MemoryDataCollector;
use Tranquillity\Utility\Profiler\DataCollector\RouterDataCollector;
use Tranquillity\Utility\Profiler\DataCollector\SettingsDataCollector;
use Tranquillity\Utility\Profiler\DataCollector\ViewDataCollector;

class ProfilerServiceProvider extends AbstractServiceProvider {
    /**
     * @inheritDoc
     */
    public function register(ContainerBuilder $containerBuilder) {
        $containerBuilder->addDefinitions([
            // Register Profiler library
            Profiler::class => function(ContainerInterface $c) {
                $config = $c->get('config');
                $profilerOptions = $config->get('profiler');
                $storageOptions = $config->get('profiler.storage_options');

                // Create profiler storage mechanism
                $storage = null;
                switch($profilerOptions['storage_type']) {
                    case 'file':
                    default:
                        $path = ArrayHelper::get($storageOptions, 'path', APP_BASE_PATH.'/var/profiler');
                        $storage = new FileProfilerStorage($path, $storageOptions);
                        break;
                }

                // Create profiler engine
                $enabled = ArrayHelper::get($profilerOptions, 'enabled', false);
                $logger = $c->get(LoggerInterface::class);
                $profiler = new Profiler($storage, $logger, $enabled);

                // Add default data collectors
                $profiler->addDataCollector(new EnvironmentDataCollector());
                $profiler->addDataCollector(new MemoryDataCollector());
                $profiler->addDataCollector(new HttpDataCollector($c->get(Session::class)));
                $profiler->addDataCollector(new RouterDataCollector());
                $profiler->addDataCollector(new SettingsDataCollector($config));

                // Add data collector for view engine
                $view = $c->get(Twig::class);
                $viewProfile = new Profile();
                $view->addExtension(new ProfilerExtension($viewProfile));
                $profiler->addDataCollector(new ViewDataCollector($viewProfile, $view->getEnvironment()));

                // Add data collector for database connection
                $connection = $c->get(Connection::class);
                $profiler->addDataCollector(new DatabaseDataCollector($connection));

                // Return the profiler engine
                return $profiler;
            }
        ]);
    }
}