<?php namespace Tranquillity\ServiceProvider;

// PSR standards interfaces
use Psr\Container\ContainerInterface;

// Library classes
use DI\ContainerBuilder;
use Slim\Views\Twig;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormFactoryBuilderInterface;
use Symfony\Component\Form\FormRenderer;
use Twig\TwigFunction;
use Twig\TwigTest;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

// Application classes
use Tranquillity\Utility\View\Node\SearchAndRenderBlockNode;
use Tranquillity\Utility\View\Node\RenderBlockNode;
use Tranquillity\Utility\View\Renderer\FormRendererEngine;
use Tranquillity\Utility\View\TestExpression\RootFormTestExpression;
use Tranquillity\Utility\View\TestExpression\SelectedChoiceTestExpression;
use Twig\TwigFilter;

class FormServiceProvider extends AbstractServiceProvider {
    /**
     * @inheritDoc
     */
    public function register(ContainerBuilder $containerBuilder) {
        $containerBuilder->addDefinitions([
            // Register Symfony form factory builder
            FormFactoryBuilderInterface::class => function(ContainerInterface $c) {
                $config = $c->get('config')->get('form');

                // Get Twig rendering environment
                $view = $c->get(Twig::class);
                $environment = $view->getEnvironment();

                // Add form-related rendering functions to the environment
                $environment->addFunction(new TwigFunction('form_widget', null, ['node_class' => SearchAndRenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form_errors', null, ['node_class' => SearchAndRenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form_label', null, ['node_class' => SearchAndRenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form_help', null, ['node_class' => SearchAndRenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form_row', null, ['node_class' => SearchAndRenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form_rest', null, ['node_class' => SearchAndRenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form', null, ['node_class' => RenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form_start', null, ['node_class' => RenderBlockNode::class, 'is_safe' => ['html']]));
                $environment->addFunction(new TwigFunction('form_end', null, ['node_class' => RenderBlockNode::class, 'is_safe' => ['html']]));

                // Add form-related filtering functions to the environment
                $environment->addFilter(new TwigFilter('humanize', [FormRenderer::class, 'humanize']));
                $environment->addFilter(new TwigFilter('form_encode_currency', [FormRenderer::class, 'encodeCurrency'], ['is_safe' => ['html'], 'needs_environment' => true]));

                // Add form-related rendering tests to the environment
                $environment->addTest(new TwigTest('rootform', RootFormTestExpression::class.'::test'));
                $environment->addTest(new TwigTest('selectedchoice', SelectedChoiceTestExpression::class.'::test'));

                // Add form renderer to Twig
                $formRenderer = new FormRendererEngine(['/controls/forms.html.twig'], $environment);
                $view->addRuntimeLoader(new FactoryRuntimeLoader([
                    FormRenderer::class => function () use ($formRenderer) {
                        return new FormRenderer($formRenderer);
                    }
                ]));

                // Create the form factory
                $formFactory = Forms::createFormFactoryBuilder();
                return $formFactory;
            }
        ]);
    }
}