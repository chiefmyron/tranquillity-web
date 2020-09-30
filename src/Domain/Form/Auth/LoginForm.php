<?php declare(strict_types=1);
namespace Tranquillity\Domain\Form\Auth;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Tranquillity\Domain\Form\AbstractForm;

class LoginForm extends AbstractForm {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('test', TextType::class);
    }
}