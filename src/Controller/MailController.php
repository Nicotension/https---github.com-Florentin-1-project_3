<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use SplSubject;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
           ->from('ijewerenicholas@gmail.com')
           ->to('ijewerenicholas@gmail.com')
           ->priority(Email::PRIORITY_HIGH)
           ->subject('Time for Symfony Mailer!')
           ->text('Sewnding emails is fun again!')
           ->html('<p>See Twig integration for better HTML intergration!</p>');

           $mailer->send($email);
           return new Response("Email sent successfully!");
       
    }
   
}

