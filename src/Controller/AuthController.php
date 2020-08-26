<?php declare(strict_types = 1);
namespace App\Controller;

use App\Form\Auth\LoginFormType;
use App\Form\Auth\ResetPasswordFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends AbstractController {
    public function login(Request $request) {
        $form = $this->createForm(LoginFormType::class);

        // Check if form has been submitted
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());

            // Auth logic

            // Redirect
            return $this->redirectToRoute('index');
        }

        return $this->render('auth/login.html.twig', [
            'loginForm' => $form->createView()
        ]);
    }

    public function passwordReset(Request $request) {
        $form = $this->createForm(ResetPasswordFormType::class);
        return $this->render('auth/forgot-password.html.twig', [
            'passwordResetForm' => $form->createView()
        ]);
    }
}
