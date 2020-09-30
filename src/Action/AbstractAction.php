<?php declare(strict_types=1);
namespace Tranquillity\Action;

// Library classes
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormFactoryBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

// Application classes
use Tranquillity\Responder\Responder;

abstract class AbstractAction {

    /**
     * @var Responder
     */
    protected $responder;

    /**
     * @var FormFactoryBuilderInterface
     */
    protected $formFactoryBuilder;

    public function __construct(Responder $responder, FormFactoryBuilderInterface $formFactoryBuilder) {
        $this->responder = $responder;
        $this->formFactoryBuilder = $formFactoryBuilder;
    }

    protected function getFormFactory() {
        return $this->formFactoryBuilder->getFormFactory();
    }

    protected function createForm(string $type = FormType::class, $data = null, array $options = []): FormInterface {
        return $this->getFormFactory()->create($type, $data, $options);
    }
}