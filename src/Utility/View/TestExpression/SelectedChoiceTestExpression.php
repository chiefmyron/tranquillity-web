<?php declare(strict_types=1);
namespace Tranquillity\Utility\View\TestExpression;

// Library classes
use Symfony\Component\Form\ChoiceList\View\ChoiceView;

class SelectedChoiceTestExpression {
    static public function test(ChoiceView $choice, $selectedValue): bool {
        if (is_array($selectedValue)) {
            return in_array($choice->value, $selectedValue, true);
        }

        return $selectedValue === $choice->value;
    }
}