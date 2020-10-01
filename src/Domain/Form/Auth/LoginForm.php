<?php declare(strict_types=1);
namespace Tranquillity\Domain\Form\Auth;

// Library classes
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

// Application classes
use Tranquillity\Domain\Form\AbstractForm;

class LoginForm extends AbstractForm {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('username', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('remember', CheckboxType::class, ['label' => 'Remember me on this device']);
    }
}