<?php declare(strict_types=1);
namespace Tranquillity\Utility\Profiler\DataCollector;

// PSR standards interfaces
use Throwable;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

// Library classes
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Profiler\Profile;

class ViewDataCollector extends AbstractDataCollector implements LateDataCollectorInterface {
    
    /**
     * @var Profile
     */
    private $templateProfile;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * Constructor
     */
    public function __construct(Profile $templateProfile, Environment $twig = null) {
        $this->templateProfile = $templateProfile;
        $this->twig = $twig;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName() {
        return 'view';
    }

    /**
     * {@inheritDoc}
     */
    public function collect(ServerRequestInterface $request, ResponseInterface $response, ?Throwable $exception = null) {
        // Do nothing - rendering can happen right up to the last minute
    }

    /**
     * {@inheritDoc}
     */
    public function lateCollect() {
        $this->data['profile'] = serialize($this->templateProfile);
        $this->data['template_paths'] = [];
        if ($this->twig === null) {
            return;
        }

        $templateFinder = function (Profile $profile) use (&$templateFinder) {
            if ($profile->isTemplate()) {
                try {
                    $template = $this->twig->load($name = $profile->getName());
                } catch (LoaderError $e) {
                    $template = null;
                }

                if (null !== $template && '' !== $path = $template->getSourceContext()->getPath()) {
                    $this->data['template_paths'][$name] = $path;
                }
            }

            foreach ($profile as $p) {
                $templateFinder($p);
            }
        };
        $templateFinder($this->templateProfile);
    }

    /**
     * {@inheritDoc}
     */
    public function reset() {
        $this->templateProfile->reset();
        $this->data = [];
    }
}