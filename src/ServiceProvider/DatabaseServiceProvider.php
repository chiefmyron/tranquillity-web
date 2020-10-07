<?php namespace Tranquillity\ServiceProvider;

// PSR standards interfaces
use Psr\Container\ContainerInterface;

// Library classes
use DI\ContainerBuilder;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Logging\DebugStack;
use Tranquillity\Utility\ArrayHelper;

class DatabaseServiceProvider extends AbstractServiceProvider {
    /**
     * @inheritDoc
     */
    public function register(ContainerBuilder $containerBuilder) {
        $containerBuilder->addDefinitions([
            // Register database connection
            Connection::class => function(ContainerInterface $c) {
                $config = $c->get('config')->get('database');
                $connection = DriverManager::getConnection($config);

                // If we are running in debug mode, add an SQL logger
                $debugMode = ArrayHelper::get($config, 'options.debug', false);
                if ($debugMode == true) {
                    $logger = new DebugStack();
                    $connection->getConfiguration()->setSQLLogger($logger);
                }

                return $connection;
            },

            // Register query builder
            QueryBuilder::class => function (ContainerInterface $c) {
                $connection = $c->get(Connection::class);
                $queryBuilder = $connection->createQueryBuilder();
                return $queryBuilder;
            }
        ]);
    }
}
