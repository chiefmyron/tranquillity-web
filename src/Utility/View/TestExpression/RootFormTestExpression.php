<?php declare(strict_types=1);
namespace Tranquillity\Utility\View\TestExpression;

// Library classes
use Symfony\Component\Form\FormView;

class RootFormTestExpression {
    static public function test(FormView $formView): bool {
        return $formView->parent === null;
    }
}