<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();


        $email = (new Email())

        ->from('ijewerenicholas@gmail.com') 
        ->to($user->getEmail())
        ->priority(Email::PRIORITY_HIGH)
        ->subject('Welcome email!')
        ->text('Sending emails is fun again!')
        ->html('<h1>Welcome to our dear customer!</h1>');

           $mailer->send($email);

           return $this->redirectToRoute('app_login');
            // do anything else you need here, like send an email
            

           }
     
         return $this->render('registration/register.html.twig', [
             'registrationForm' => $form,
         ]);
    }


    
}
