<?php namespace Tranquillity\ServiceProvider;

// PSR standards interfaces
use Psr\Container\ContainerInterface;

// Library classes
use DI\ContainerBuilder;
use Doctrine\DBAL\Connection;
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
use Tranquillity\Exception\NotImplementedException;

class SessionServiceProvider extends AbstractServiceProvider {
    /**
     * @inheritDoc
     */
    public function register(ContainerBuilder $containerBuilder) {
        $containerBuilder->addDefinitions([
            // Register session library
            Session::class => function(ContainerInterface $c) {
                $config = $c->get('config')->get('session');
                $options = ArrayHelper::get($config, 'options', []);
                $storageOptions = ArrayHelper::get($config, 'storage_options', []);

                // If being called from the command line, session is not required
                if (PHP_SAPI === 'cli') {
                    return new Session(new MockArraySessionStorage());
                }

                // Get storage handler
                $storageHandler = null;
                switch(strtolower($config['storage_type'])) {
                    case 'native':
                        $savePath = ArrayHelper::get($storageOptions, 'save_path', '');
                        $storageHandler = new NativeFileSessionHandler($savePath);
                        break;
                    case 'pdo':
                        $dsn = ArrayHelper::get($storageOptions, 'db_dsn', '');
                        if ($dsn === '') {
                            $connection = $c->get(Connection::class);
                            $dsn = $connection->getWrappedConnection();
                        }
                        $storageHandler = new PdoSessionHandler($dsn, $storageOptions);
                        break;
                    case 'redis':
                    case 'memcached':
                    case 'mongodb':
                    default:
                        throw new NotImplementedException('Session storage handler for "'.$config['storage_type'].'" has not yet been implemented.');
                        break;
                }

                // Use native PHP session storage wrapper and create session
                $session = new Session(new NativeSessionStorage($options, $storageHandler));
                return $session;
            },

            // Use same mapping for SessionInterface
            SessionInterface::class => function(ContainerInterface $c) {
                return $c->get(Session::class);
            }
        ]);
    }
}