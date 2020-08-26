<?php declare(strict_types = 1);
namespace App\Form\Auth;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginFormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', TextType::class)
                ->add('password', PasswordType::class)
                ->add('remember', CheckboxType::class, [
                    'label' => 'Remember me on this device'
                ]);
    }
}
