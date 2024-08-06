<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StaticController extends AbstractController
{
    #[Route('/static', name: 'app_static')]
    public function index(ProductRepository $productRepository): Response
    {   
       

        return $this->render('static/index.html.twig', [
            'products' => $productRepository->findAll(),
           
        ]);


        

    }

    
}
