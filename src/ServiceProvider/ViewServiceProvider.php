<?php namespace Tranquillity\ServiceProvider;

// PSR standards interfaces
use Psr\Container\ContainerInterface;

// Library classes
use DI\ContainerBuilder;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Session;

// Application classes
use Tranquillity\Utility\ArrayHelper;
use Twig\TwigFunction;

class ViewServiceProvider extends AbstractServiceProvider {
    /**
     * @inheritDoc
     */
    public function register(ContainerBuilder $containerBuilder) {
        $containerBuilder->addDefinitions([
            // Register Twig view library
            Twig::class => function(ContainerInterface $c) {
                $config = $c->get('config')->get('view');

                // Define Twig options
                $path = $config['template_path'];
                $options = $config['options'];

                // Set cache options
                $cacheEnabled = ArrayHelper::get($config, 'cache_enabled', true);
                if ($cacheEnabled == false) {
                    $options['cache'] = false;
                } else {
                    $options['cache'] = ArrayHelper::get($config, 'cache_path', APP_BASE_PATH.'/var/cache');
                }

                // Create templating component
                $view = Twig::create($path, $options);

                // Add support for 'flash' messaging via session
                $flashbag = $c->get(Session::class)->getFlashbag();
                $environment = $view->getEnvironment();
                $environment->addGlobal('flashbag', $flashbag);

                $flashFunction = new TwigFunction('flash', function(string $key, $default = null) use ($flashbag) {
                    return $flashbag->get($key, $default ?? [])[0] ?? null;
                });
                $environment->addFunction($flashFunction);

                return $view;
            }
        ]);
    }
}