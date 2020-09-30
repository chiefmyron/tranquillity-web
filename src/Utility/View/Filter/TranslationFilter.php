<?php declare(strict_types=1);
namespace Tranquillity\Utility\View\Filter;

// Library classes
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatableInterface;

class TranslationFilter {
    /**
     * @var Translator
     */
    private $translator;

    public function  __construct(Translator $translator) {
        $this->translator = $translator;
    }

    public function __invoke(?string $message, $arguments = [], string $domain = null, string $locale = null, int $count = null): string {
        if (null === $message || '' === $message) {
            return '';
        }

        if (null !== $count) {
            $arguments['%count%'] = $count;
        }

        return $this->getTranslator()->trans($message, $arguments, $domain, $locale);
    }

    private function getTranslator() {
        return $this->translator;
    }
}