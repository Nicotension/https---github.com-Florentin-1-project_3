<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    // public function index(): Response
    // {
    //     return $this->render('payment/index.html.twig', [
    //         'controller_name' => 'PaymentController',
    //     ]);
    // }

    public function payment(Request $request): Response
    {
        return $this->render('payment/index.html.twig');
    }

    
     #[Route("/payment/submit", name: "payment_submit", methods: ["POST"])]
     
    public function paymentSubmit(Request $request): Response
    {
        // Handle form submission
        $data = $request->request->all();
        // Here, you would process the payment and provide feedback to the user

        return $this->redirectToRoute('payment_success');
    }

    
     #[Route("/payment/success", name:"payment_success")]
    
    public function paymentSuccess(): Response
    {
        return $this->render('payment/approval.html.twig');
    }


}
