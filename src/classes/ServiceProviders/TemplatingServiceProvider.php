<?php declare(strict_types=1);
namespace Tranquillity\ServiceProviders;

// PSR standards interfaces
use Psr\Container\ContainerInterface;

// Library classes
use DI\ContainerBuilder;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

class TemplatingServiceProvider extends AbstractServiceProvider {
    /**
     * Registers the service with the application container
     * 
     * @return void
     */
    public function register(ContainerBuilder $containerBuilder, string $name) {
        $containerBuilder->addDefinitions([
            // Register main Twig View class
            Twig::class => function(ContainerInterface $c) {
                $config = $c->get('config')->get('app.templating');
                $twig = Twig::create($config['template_paths'], $config['options']);

                return $twig;
            }
        ]);
    }
}