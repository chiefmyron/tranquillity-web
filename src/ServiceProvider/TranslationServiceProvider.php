<?php namespace Tranquillity\ServiceProvider;

// PSR standards interfaces
use Psr\Container\ContainerInterface;

// Library classes
use DI\ContainerBuilder;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\CsvFileLoader;
use Symfony\Component\Translation\Loader\IcuDatFileLoader;
use Symfony\Component\Translation\Loader\IcuResFileLoader;
use Symfony\Component\Translation\Loader\IniFileLoader;
use Symfony\Component\Translation\Loader\JsonFileLoader;
use Symfony\Component\Translation\Loader\MoFileLoader;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\Loader\PoFileLoader;
use Symfony\Component\Translation\Loader\QtFileLoader;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Slim\Views\Twig;
use Twig\TwigFilter;

// Application classes
use Tranquillity\Utility\ArrayHelper;
use Tranquillity\Utility\View\Filter\TranslationFilter;
use Tranquillity\Exception\InvalidConfigValueException;

class TranslationServiceProvider extends AbstractServiceProvider {
    /**
     * @inheritDoc
     */
    public function register(ContainerBuilder $containerBuilder) {
        $containerBuilder->addDefinitions([
            // Register translations library
            Translator::class => function(ContainerInterface $c) {
                $config = $c->get('config')->get('translation');
                $options = $config['options'];

                // Set cache options
                $cacheEnabled = ArrayHelper::get($config, 'cache_enabled', true);
                if ($cacheEnabled == false) {
                    $options['cache'] = null;
                } else {
                    $options['cache'] = ArrayHelper::get($config, 'cache_path', APP_BASE_PATH.'/var/cache');
                }

                // Create instance of the translation service
                $translator = new Translator($config['default_locale'], null, $options['cache'], $options['debug']);

                // Set the file loader for translation files
                switch (strtolower($config['type'])) {
                    case 'csv':
                        $translator->addLoader($config['type'], new CsvFileLoader());
                        break;
                    case 'icu-dat':
                        $translator->addLoader($config['type'], new IcuDatFileLoader());
                        break;
                    case 'icu-res':
                        $translator->addLoader($config['type'], new IcuResFileLoader());
                        break;
                    case 'ini':
                        $translator->addLoader($config['type'], new IniFileLoader());
                        break;
                    case 'json':
                        $translator->addLoader($config['type'], new JsonFileLoader());
                        break;
                    case 'mo':
                        $translator->addLoader($config['type'], new MoFileLoader());
                        break;
                    case 'php':
                        $translator->addLoader($config['type'], new PhpFileLoader());
                        break;
                    case 'po':
                        $translator->addLoader($config['type'], new PoFileLoader());
                        break;
                    case 'qt':
                        $translator->addLoader($config['type'], new QtFileLoader());
                        break;
                    case 'xliff':
                        $translator->addLoader($config['type'], new XliffFileLoader());
                        break;
                    case 'yaml':
                        $translator->addLoader($config['type'], new YamlFileLoader());
                        break;
                    default:
                        throw new InvalidConfigValueException('Translation file type "'.$config['type'].'" is not recognised. (Setting key: translation.type)');
                        break;

                }

                // Get Twig rendering environment
                $view = $c->get(Twig::class);
                $environment = $view->getEnvironment();

                // Add translation-related rendering filters to the environment
                $environment->addFilter(new TwigFilter('trans', new TranslationFilter($translator)));

                return $translator;
            }
        ]);
    }
}