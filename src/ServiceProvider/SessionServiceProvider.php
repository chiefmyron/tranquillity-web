<?php namespace Tranquillity\ServiceProvider;

// PSR standards interfaces
use Psr\Container\ContainerInterface;

// Library classes
use DI\ContainerBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\MemcachedSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\MongoDbSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\RedisSessionHandler;

// Application classes
use Tranquillity\Utility\ArrayHelper;

class SessionServiceProvider extends AbstractServiceProvider {
    // Valid session storage handlers
    private $storageHandlers = [
        'native' => NativeFileSessionHandler::class, 
        'pdo' => PdoSessionHandler::class, 
        'redis' => RedisSessionHandler::class, 
        'memcached' => MemcachedSessionHandler::class, 
        'mongodb' => MongoDbSessionHandler::class
    ];

    /**
     * @inheritDoc
     */
    public function register(ContainerBuilder $containerBuilder) {
        $containerBuilder->addDefinitions([
            // Register session library
            Session::class => function(ContainerInterface $c) {
                $config = $c->get('config')->get('session');

                // If being called from the command line, session is not required
                if (PHP_SAPI === 'cli') {
                    return new Session(new MockArraySessionStorage());
                }

                // Get storage handler
                $storageHandlerType = strtolower($config['storage_type']);
                $storageHandlerClassname = ArrayHelper::get($this->storageHandlers, $storageHandlerType, NativeFileSessionHandler::class);
                $storageHandler = new $storageHandlerClassname($config['storage_options']);

                // Use native PHP session storage wrapper and create session
                $session = new Session(new NativeSessionStorage($config['options'], $storageHandler));
                return $session;
            },

            // Use same mapping for SessionInterface
            SessionInterface::class => function(ContainerInterface $c) {
                return $c->get(Session::class);
            }
        ]);
    }
}