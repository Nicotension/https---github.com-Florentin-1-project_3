<?php

namespace App\Controller;

use SplSubject;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
           ->from('theemailaddress@.com')
           ->to('ijewerenicholas@gmail.com')
           ->priority(Email::PRIORITY_HIGH)
           ->subject('Time for Symfony Mailer!')
           ->text('Sewnding emails is fun again!')
           ->html('<p>See Twig integration for better HTML intergration!</p>');

           $mailer->send($email);
           return new Response("Email sent successfully!");
########        
        // return $this->render('mail/index.html.twig', [
        //     'controller_name' => 'MailController',
        // ]);
########        
    }
}

